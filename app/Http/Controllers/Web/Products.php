<?php

namespace App\Http\Controllers\Web;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Products as ResourcesProducts;
use App\Models\Product;

class Products extends Controller
{
  public $categories;

  public function __construct()
  {
    $this->categories = $categories = Category::tree();
  }

  public function search(Request $request)
    {

      $query = Product::query();
      $categories = Category::tree();
      $q = $request->get('q');

      if($request->has('q'))
        $query->where(function($q) use ($request) {
          $q->where('name', 'LIKE', "%{$request->get('q')}%")
            ->orWhere('sku', 'LIKE', "%{$request->get('q')}%");
        });

      $products = ResourcesProducts::collection($query->get());

      return view('web.pages.products', compact('categories', 'products', 'q'));
    }

  public function all(Request $request) {
    $categories = Category::tree();
    $products = Product::where('available', 1);

    // if($request->has('category'))

    $products->orderBy('products.updated_at', 'DESC');
    $products = ResourcesProducts::collection($products->get());
    return view('web.pages.products', compact('categories', 'products'));
  }

  public function index(Request $request, $category, $product) {
    $category = Category::where('slug', $category)->get()->first();
    $categories = Category::tree();
    if(!isset($category))
      return view('web.pages.404');

    $product = $category->products()->where('slug', $product)->get()->first();

    if(!isset($product))
      return view('web.pages.404');
    return view('web.pages.single-product', compact('category', 'product', 'categories'));
  }

  public function uncategorised($product)
  {
    $product = Product::where('slug', $product)->get()->first();
    $categories = Category::tree();
    if(!isset($product))
      return view('web.pages.404');
    return view('web.pages.single-product', compact('product', 'categories'));
  }
}
