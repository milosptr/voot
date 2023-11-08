<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
          'user_id' => 'required',
        ]);

        $user = User::find($request->get('user_id'));

        if ($user == null || !auth()->user()) {
            return response("Sorry, we cannot find you in our customers database, please call us for more info!", 422);
        }

        $subaccount = isset($_COOKIE['order_for_user']) ? $_COOKIE['order_for_user'] : null;
        $data = [
          'sku' => $request->get('sku'),
          'quantity' => $request->get('qty'),
          'comment' => $request->get('comment'),
          'subaccount_id' => $subaccount,
          'user_id' => $user->id,
        ];

        $existingCart = Cart::where('user_id', $user->id)
                            ->where('sku', $request->get('sku'))
                            ->where('subaccount_id', $subaccount)
                            ->first();

        try {
            if ($existingCart) {
                $existingCart->update(['quantity' => $existingCart->quantity + $request->get('qty')]);
                return response()->json([
                  'message' => 'Product added to cart successfully!'
                ]);
            } else {
                Cart::create($data);
                return response()->json([
                  'message' => 'Product added to cart successfully!'
                ]);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
              'message' => $e->getMessage()
            ]);
        }
    }

    public function update($user_id, Request $request)
    {
        $cart = Cart::where('user_id', $user_id)->first();
        $cart->update(['cart' => $request->all()]);
        return $cart;
    }

    public function updateCart($cart_id, Request $request)
    {
        $cart = Cart::find($cart_id);
        $cart->update($request->only('quantity'));
        return $cart;
    }

    public function destroy($cart_id)
    {
        $cart = Cart::find($cart_id);
        return $cart->delete();
    }
}
