<?php

namespace App\Http\Controllers\Web;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\PaginationService;
use App\Http\Controllers\Controller;
use App\Http\Resources\Products as ResourcesProducts;
use App\Models\ProductFavourite;
use App\Models\ProductVariation;

class Products extends Controller
{
  public $categories;

  public function __construct()
  {
    $this->categories = $categories = Category::tree();
  }

  public function search(Request $request)
    {
      if($request->get('q') === null)
        return back();
      $query = Product::query();
      $categories = Category::tree();
      $q = $request->get('q');

      if($request->has('q'))
        $query->where(function($qry) use($request) {
          $variations = ProductVariation::whereLike('sku', $request->get('q'))->pluck('product_id');
          $qry->whereLike(['name', 'sku', 'english_name'], $request->get('q'))
              ->orWhereIn('id', $variations);
        });
      $query->where('available', 1);
      $products = ResourcesProducts::collection($query->get());

      return view('web.pages.products', compact('categories', 'products', 'q'));
    }

  public function all(Request $request) {
    $categories = Category::tree();
    $products = Product::where('available', 1)->orderBy('products.updated_at', 'DESC')->paginate(20);
    $products = ResourcesProducts::collection($products);
    $pagination = PaginationService::extract($products);
    $isFirstPage = $request->get('page') === NULL || $request->get('page') === '1';
    $favourites = auth()->user() && $isFirstPage ? ResourcesProducts::collection(auth()->user()->favourites) : [];
    return view('web.pages.products', compact('categories', 'products', 'pagination', 'favourites'));
  }

  public function index(Request $request, $category, $product) {
    $category = Category::where('slug', $category)->get()->first();
    $categories = Category::tree();
    if(!isset($category))
      return view('web.pages.404');

    $product = $category->products()->where('slug', $product)->where('available', 1)->get()->first();

    if(!isset($product))
      return view('web.pages.404');
    return view('web.pages.single-product', compact('category', 'product', 'categories'));
  }

  public function uncategorised($product)
  {
    $product = Product::where('slug', $product)->where('available', 1)->get()->first();
    $categories = Category::tree();
    if(!isset($product))
      return view('web.pages.404');
    return view('web.pages.single-product', compact('product', 'categories'));
  }
}
