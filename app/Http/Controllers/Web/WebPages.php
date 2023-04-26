<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Config;
use App\Models\Product;
use App\Models\RequestPriceCart;

class WebPages extends Controller
{
    public function index()
    {
        $categories = Category::where('parent_id', 0)->get();
        $products = count(Config::getHomepageProducts()) ? Config::getHomepageProducts() : Product::where('available', 1)->orderBy('id', 'DESC')->get()->take(8);

        return view('web.pages.homepage', compact('categories', 'products'));
    }

    public function homepage()
    {
        $categories = Category::where('parent_id', 0)->get();
        $products = count(Config::getHomepageProducts()) ? Config::getHomepageProducts() : Product::where('available', 1)->orderBy('id', 'DESC')->get()->take(8);

        return view('web.pages.homepage-2', compact('categories', 'products'));
    }

    public function about()
    {
        return view('web.pages.about');
    }

    public function services()
    {
        return view('web.pages.services');
    }

    public function brands()
    {
        return view('web.pages.our-brands');
    }

    public function contact()
    {
        return view('web.pages.contact');
    }

    public function cart()
    {
        if(auth()->user() === null) {
            return redirect()->intended('/login?back=cart');
        }
        $cart = Cart::where('user_id', auth()->user()->id)->first();
        return view('web.pages.cart', compact('cart'));
    }

    public function cartRequest()
    {
        $authId = request()->cookie('auth_id');
        if($authId === null) {
            return redirect()->intended('/login');
        }

        $cart = RequestPriceCart::where('user_id', $authId)->get();
        return view('web.pages.cart-request', compact('cart'));
    }

    public function checkout()
    {
        if(auth()->user() === null) {
            return redirect()->intended('/login?back=checkout');
        }
        $cart = Cart::where('user_id', auth()->user()->id)->first();
        if($cart) {
            $companies = auth()->user()->companies;
            return view('web.pages.checkout', compact('cart', 'companies'));
        }
        return redirect()->intended('/cart');
    }

    public function thanks()
    {
        return view('web.pages.thanks');
    }
}
