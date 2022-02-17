<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductFavourite;
use Illuminate\Http\Request;

class ProductFavouriteController extends Controller
{

  public function index($product, $user)
  {
    return ProductFavourite::where(['product_id' => $product, 'user_id' => $user])->get();
  }

  public function store(Request $request)
  {
    return ProductFavourite::create(['product_id' => $request->get('product_id'), 'user_id' => $request->get('user_id')]);
  }

  public function destroy($product, $user)
  {
    $pf = ProductFavourite::where(['product_id' => $product, 'user_id' => $user])->first();
    return $pf->delete();
  }
}
