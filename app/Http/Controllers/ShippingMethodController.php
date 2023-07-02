<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShippingMethod;
use App\Models\User;

class ShippingMethodController extends Controller
{
    //

    public function index()
    {
        return ShippingMethod::all();
    }

    public function store(Request $request)
    {
        $shippingMethod = ShippingMethod::create($request->only(['key', 'name', 'shortName']));
        return response()->json($shippingMethod, 201);
    }

    public function update(Request $request, $id)
    {
        $shippingMethod = ShippingMethod::findOrFail($id);
        $shippingMethod->update($request->only(['key', 'name', 'shortName']));
        return response()->json($shippingMethod, 200);
    }

    public function destroy($id)
    {
        ShippingMethod::destroy($id);
        $clients = User::where('default_shipping_id', $id)->get();
        foreach ($clients as $client) {
            $client->default_shipping_id = null;
            $client->save();
        }
        return response()->json(null, 204);
    }
}
