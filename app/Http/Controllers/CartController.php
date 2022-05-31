<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request)
    {
      $request->validate([
        'user_id' => 'required',
      ]);

      $cart = Cart::where('user_id', $request->get('user_id'))->first();
      $user = User::find($request->get('user_id'));

      if ($user == NULL)
        return response("Sorry, we cannot find you in our customers database, please call us for more info!", 422);
      if ($cart == null) {
          $data = [
            'user_id' => $user->id,
            'cart' => json_encode(array([ 'sku' => $request->get('sku'), 'qty' => $request->get('qty') ]))
          ];
          return Cart::create($data);
      }

      $cartData = json_decode($cart->cart);

      $existingIndex = array_search($request->get('sku'), array_column($cartData, 'sku'));
      if($existingIndex !== false) {
        $cartData[$existingIndex]->qty = (int) $cartData[$existingIndex]->qty + (int) $request->get('qty');
      } else {
        array_push($cartData, [ 'sku' => $request->get('sku'), 'qty' => $request->get('qty') ]);
      }

      return $cart->update(['cart' => $cartData]);
    }

    public function update($user_id, Request $request)
    {
      $cart = Cart::where('user_id', $user_id)->first();
      $cart->update(['cart' => $request->all()]);
      return $cart;
    }

    public function destroy($user_id, $sku)
    {
      $cart = Cart::where('user_id', $user_id)->first();
      $cartData = array_filter(json_decode($cart->cart, TRUE), function($i) use ($sku) {
        return $i['sku'] !== $sku;
      });
      $cartData = array_map(function($i) { return $i;}, $cartData);
      dd($cart->cart);
      $cart->cart = $cartData;
      return $cart->save();
    }
}
