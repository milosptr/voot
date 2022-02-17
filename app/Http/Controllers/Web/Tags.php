<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tag;

class Tags extends Controller
{
  public function indexProducts($slug)
  {
    $tag = Tag::where('slug', $slug)->first();
    if ($tag) {
        $categories = Category::tree();
        $products = $tag->products()->orderBy('products.id', 'DESC')->get();

        if ($products) {
            return view('web.pages.products', compact('categories', 'products', 'tag'));
        }
    }
    return view('web.pages.404');
  }
}
