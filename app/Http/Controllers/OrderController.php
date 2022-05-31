<?php

namespace App\Http\Controllers;

use App\Events\OrderCreated;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use Carbon\Carbon;
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
      $shippingNote = $request->get('note');
      $shippingMethod = $request->get('shippingMethod');
      $pickupLocation = $request->get('pickupLocation');

      if($shippingAddress === NULL)
        $shippingAddress = $customer->street . ', ' . $customer->city . ' ' . $customer->zip . ', ' . $customer->country;

      $order = Order::create([
        'user_id' => $customer->id,
        'order_status' => Order::STATUS_REQUESTED,
        'order' => json_decode($cart->cart),
        'shipping_method' => $shippingMethod,
        'shipping_address' => $shippingAddress,
        'shipping_date' => Carbon::parse($shippingDate),
        'pickup_location' => $pickupLocation,
        'note' => $shippingNote
      ]);

      OrderCreated::dispatch($order);

      $cart->delete();

      return response('Order successfuly requested!', 200);
    }

    public function update(Request $request, $id)
    {
      $order = Order::find($id);
      $order->update($request->only('order', 'shipping_address', 'shipping_date', 'note'));

      return back()->with('success', 'Order updated successfully!');
    }

    public function reorder($id)
    {
      $order = Order::findOrFail($id);
      $cart = Cart::where('user_id', $order->user_id)->first();
      if(isset($cart)) {
        $cartItems = json_decode($cart->cart);
        $items = array_merge($cartItems, $order->order);
        $cart->update([
          'cart' => $items
        ]);
      } else {
        Cart::create($order->order);
      }

      return redirect()->intended('/cart');
    }
}
