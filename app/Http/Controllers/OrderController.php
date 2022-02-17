<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function store(Request $request, $customerID)
    {
      $customer = User::find($customerID);
      if($customer === NULL)
        return response('Customer not found, login and try again.', 422);

      $cart = $customer->cart;
      if($cart === NULL)
        return response('Your shopping cart is empty, try again!', 422);

      $shippingAddress = $request->get('shippingAddress');
      $shippingDate = $request->get('shippingDate');

      if($shippingAddress === NULL)
        $shippingAddress = $customer->street . ', ' . $customer->city . ' ' . $customer->zip . ', ' . $customer->country;

      Order::create([
        'customer_id' => $customer->key,
        'order_status' => Order::STATUS_REQUESTED,
        'order' => $cart->cart,
        'shipping_address' => $shippingAddress,
        'shipping_date' => $shippingDate
      ]);

      $cart->delete();

      return response('Order successfuly requested!', 200);
    }

    public function update(Request $request, $id)
    {
      $order = Order::find($id);
      $order->update($request->only('order', 'shipping_address', 'shipping_date', 'note'));

      return back()->with('success', 'Order updated successfully!');
    }
}
