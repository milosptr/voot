<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Str;
use App\Models\RequestPrice;
use Illuminate\Http\Request;
use App\Models\RequestPriceCart;
use App\Events\RequestPriceEvent;
use Illuminate\Support\Facades\Log;

class RequestPriceCartController extends Controller
{
    public function store(Request $request)
    {
        $authId = $request->cookie('auth_id');

        if (!Str::isUuid($authId)) {
            // Handle the case where $authId is not a valid UUID
            return response()->json(['error' => 'Invalid auth ID'], 400);
        }

        try {
            $request->validate([
                'product_sku' => 'required',
                'quantity' => 'required|numeric',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => 'Something went wrong, try again!'], 422);
        }

        $productExists = RequestPriceCart::where('user_id', $authId)
            ->where('product_sku', $request->product_sku);
        if($productExists->exists()) {
            $cart = RequestPriceCart::find($productExists->first()->id);
            $cart->quantity = (int) $cart->quantity + (int) $request->quantity;
            $cart->save();
            return response()->json($cart);
        }

        $cart = RequestPriceCart::create([
            'user_id' => $authId,
            'product_sku' => $request->product_sku,
            'quantity' => $request->quantity,
        ]);

        return response()->json($cart);
    }

    public function askForPrice(Request $request)
    {
        $authId = $request->cookie('auth_id');

        if (!Str::isUuid($authId)) {
            return back()->with('error', 'Invalid auth ID');
        }


        $carts = RequestPriceCart::select('product_sku as sku', 'quantity as qty')->where('user_id', $authId)->get();
        if($carts->count() > 0) {
            try {
                $order = RequestPrice::create([
                  'user_id' => $authId,
                  'order' => json_encode($carts->toArray()),
                  'name' => $request->get('name'),
                  'email' => $request->get('email'),
                  'phone' => $request->get('phone'),
                  'ssn' => $request->get('ssn'),
                  'note' => $request->get('note'),
                ]);
                if($order) {
                    RequestPriceEvent::dispatch($order);
                    RequestPriceCart::where('user_id', $authId)->delete();
                }
            } catch (Exception $e) {
                Log::error('Could not store request price to database: '.$e->getMessage());
            }
        }

        return redirect()->intended('/thanks');
    }

    public function destroy($id)
    {
        try {
            $cart = RequestPriceCart::find($id);
            if($cart) {
                $cart->delete();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back();
        }

        return redirect()->back();
    }
}
