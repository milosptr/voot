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
        if($request->get('q') === null) {
            return back();
        }
        $query = Product::query();
        $categories = Category::tree();
        $products = [];
        $q = $request->get('q');

        if($request->has('q')) {
            $variations = ProductVariation::where(function ($q) use ($request) {
                $q->where('sku', 'LIKE', '%'.$request->get('q').'%')
                  ->orWhere('value', 'LIKE', '%'.$request->get('q').'%');
            })->pluck('product_id');

            $products = $query->where(function ($q) use ($request) {
                $q->where('name', 'LIKE', '%'.$request->get('q').'%')
                  ->orWhere('english_name', 'LIKE', '%'.$request->get('q').'%')
                  ->orWhere('sku', 'LIKE', '%'.$request->get('q').'%')
                  ->orWhere('description', 'LIKE', '%'.$request->get('q').'%');
            })->pluck('id');

            $product_ids = array_merge($variations->toArray(), $products->toArray());
            $product_ids = array_values(array_unique($product_ids));

            $products = Product::whereIn('id', $product_ids)->where('available', 1)->orderBy('updated_at', 'DESC')->paginate(24);
            $pagination = PaginationService::extract($products);
            $products = ResourcesProducts::collection($products);
        }

        return view('web.pages.products', compact('categories', 'products', 'pagination', 'q'));
    }

    public function all(Request $request)
    {
        $categories = Category::tree();
        $products = Product::where('available', 1)->orderBy('products.updated_at', 'DESC')->paginate(20);
        $products = ResourcesProducts::collection($products);
        $pagination = PaginationService::extract($products);
        $isFirstPage = $request->get('page') === null || $request->get('page') === '1';
        $favourites = auth()->user() && $isFirstPage ? ResourcesProducts::collection(auth()->user()->favourites) : [];
        return view('web.pages.products', compact('categories', 'products', 'pagination', 'favourites'));
    }

    public function index(Request $request, $category, $product)
    {
        $category = Category::where('slug', $category)->get()->first();
        $categories = Category::tree();
        if(!isset($category)) {
            return view('web.pages.404');
        }

        $product = $category->products()->where('slug', $product)->where('available', 1)->get()->first();

        if(!isset($product)) {
            return view('web.pages.404');
        }
        return view('web.pages.single-product', compact('category', 'product', 'categories'));
    }

    public function uncategorised($product)
    {
        $product = Product::where('slug', $product)->where('available', 1)->get()->first();
        $categories = Category::tree();
        if(!isset($product)) {
            return view('web.pages.404');
        }
        return view('web.pages.single-product', compact('product', 'categories'));
    }
}
