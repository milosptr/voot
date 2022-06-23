<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Config;
use App\Models\Product;
use Illuminate\Http\Request;

class WebPages extends Controller
{
    public function index()
    {
      $categories = Category::where('parent_id', 0)->get();
      $products = count(Config::getHomepageProducts()) ? Config::getHomepageProducts() : Product::where('available', 1)->orderBy('id', 'DESC')->get()->take(8);

      return view('web.pages.homepage', compact('categories', 'products'));
    }

    public function about()
    {
      return view('web.pages.about');
    }

    public function services()
    {
      return view('web.pages.services');
    }

    public function contact()
    {
      return view('web.pages.contact');
    }

    public function cart()
    {
      if(auth()->user() === NULL)
        return redirect()->intended('/login?back=cart');
      $cart = Cart::where('user_id', auth()->user()->id)->first();
      return view('web.pages.cart', compact('cart'));
    }

    public function thanks()
    {
      return view('web.pages.thanks');
    }
}
