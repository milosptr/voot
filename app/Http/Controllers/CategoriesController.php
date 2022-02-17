<?php

namespace App\Http\Controllers;

use App\Http\Resources\Categories;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

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
    return Categories::collection(Category::all());
  }

  public function store(Request $request)
  {
    $category = $request->only('name','slug','description','parent_id');

    try {
      Category::create($category);
    } catch(Exception $e) {
      redirect()->back()->withErrors(['message' => 'Woops! Product cannot be added.', 'status' => 412]);
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

  public function destroy($id) {
    $category = Category::find($id);
    $category->delete();
    return redirect()->back();
  }
}
