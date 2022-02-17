<?php

namespace App\Http\Controllers\Web;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Products;
use App\Models\Product;

class CategorySubcategoryProduct extends Controller
{

  public function index(Request $request, $category = null, $product = null) {
    $categories = Category::tree();
    $category = Category::where('slug', $category)->get()->first();
    $products = $category ? $category->products()->orderBy('category_order', 'ASC')->get() : [];

    if($category) {
      return view('web.pages.category', compact('categories', 'category', 'products'));
    }

    return view('web.pages.404');
  }
}
