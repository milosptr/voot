<?php

namespace App\Http\Controllers;

use App\Http\Resources\Categories;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoriesController extends Controller
{

  public function __construct(Request $request)
  {
    $request['available'] = $request['available'] == "on" ? true : false;
  }

  // returns category with parent category if has for choosen product
  public function index($id) {
    return new Categories(Category::find($id));
  }

  // returns all categories
  public function all()
  {
    return Categories::collection(Category::formatWithSubcategories());
  }

  public function store(Request $request)
  {
    $category = $request->only('name','slug','description','parent_id');

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
    if(!$category)
      return redirect()->back()->withErrors(['message' => 'Woops! Product cannot be updated.', 'status' => 412]);

    $category->update($request->all());
    return redirect('/backend/categories');
  }

  public function reorder(Request $request)
  {
    foreach($request->all() as $order)
    {
      $product = Product::find($order['product_id']);
      if($product === NULL) continue;
      $product->category_order = $order['category_order'];
      $product->save();
    }
    return true;
  }

  public function sortCategories(Request $request)
  {
    foreach($request->all() as $key => $cat) {
      if(isset($cat['id'])) {
        $category = Category::find($cat['id']);
        $category->update(['order' => $key, 'parent_id' => 0]);
        foreach($cat['children'] as $subkey => $sub) {
          $subcategory = Category::find($sub['id']);
          $subcategory->update(['order' => $subkey, 'parent_id' => $cat['id']]);
          foreach($sub['children'] as $subsubkey => $subsub) {
            $subsubcategory = Category::find($subsub['id']);
            $subsubcategory->update(['order' => $subsubkey, 'parent_id' => $subsub['id']]);
          }
        }
      }
    }
    return $request->all();
  }

  public function destroy($id) {
    $category = Category::find($id);
    $category->delete();
    return redirect()->back();
  }
}
