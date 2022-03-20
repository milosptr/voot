<?php

namespace App\Http\Controllers\Web;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Categories extends Controller
{

  public function all(Request $request) {
    $categories = Category::tree();

    return view('web.pages.categories', compact('categories'));
  }

  public function index(Request $request, $category = null) {
    $categories = Category::tree();
    $category = Category::where('slug', $category)->get()->first();

    if($category) {
      $products = $category->products()->orderBy('category_order', 'ASC')->get();
      return view('web.pages.category', compact('categories', 'category', 'products'));
    }

    return view('web.pages.404');
  }
}
