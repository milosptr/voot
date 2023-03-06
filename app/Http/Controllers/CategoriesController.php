<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductCategories;
use App\Http\Resources\Categories;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\CategoriesWithChildren;

class CategoriesController extends Controller
{
    public function __construct(Request $request)
    {
        $request['available'] = $request['available'] == "on" ? true : false;
    }

    // returns category with parent category if has for choosen product
    public function index($id)
    {
        return new Categories(Category::find($id));
    }

    // returns all categories
    public function all()
    {
        return Categories::collection(Category::formatWithSubcategories());
    }

    // returns all categories by parent id
    public function byParent($id = 0)
    {
        return CategoriesWithChildren::collection(Category::where('parent_id', $id)->orderBy('order')->get());
    }

    public function store(Request $request)
    {
        $category = $request->only('name', 'slug', 'description', 'parent_id');

        try {
            Category::create($category);
        } catch(Exception $e) {
            Log::error("Category creating error: ". $e->getMessage());
            redirect()->back()->withErrors(['message' => 'Woops! Category cannot be added.', 'status' => 412]);
        }

        return redirect('/backend/categories');
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->back()->withErrors(['message' => 'Woops! Product cannot be updated.', 'status' => 412]);
        }

        $category->update($request->all());
        return redirect('/backend/categories');
    }

    public function reorder(Request $request)
    {
        foreach ($request->all() as $order) {
            if (isset($order['product_id'])) {
                $product = Product::find($order['product_id']);
                if ($product === null) {
                    continue;
                }
                $product->category_order = $order['category_order'];
                $product->save();
            }
        }
        return true;
    }

    public function sortCategoriesv2(Request $request)
    {
        foreach ($request->all() as $cat) {
            if (isset($cat['id'])) {
                $category = Category::find($cat['id']);
                if ($category) {
                    $category->update(['order' => $cat['order']]);
                }
            }
        }
    }

    public function sortCategories(Request $request)
    {
        foreach ($request->all() as $key => $cat) {
            if (isset($cat['id'])) {
                $category = Category::find($cat['id']);
                $category->update(['order' => $cat['order'], 'parent_id' => 0]);
                if (isset($cat['children'])) {
                    foreach ($cat['children'] as $subkey => $sub) {
                        $subcategory = Category::find($sub['id']);
                        $subcategory->update(['order' => $sub['order'], 'parent_id' => $sub['parent_id']]);
                        if (isset($sub['children'])) {
                            foreach ($sub['children'] as $subsubkey => $subsub) {
                                $subsubcategory = Category::find($subsub['id']);
                                $subsubcategory->update(['order' => $subsub['order'], 'parent_id' => $subsub['parent_id']]);
                            }
                        }
                    }
                }
            }
        }
        return $request->all();
    }

    public function destroy($id)
    {
        if (isset($id)) {
            $category = Category::find($id);
            ProductCategories::where('category_id', $category->id)->delete();
            return $category->delete();
        }
        return response('Cannot delete without id!', 200);
    }
}
