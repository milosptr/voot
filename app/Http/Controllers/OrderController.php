<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Email;
use App\Models\Order;
use App\Models\Inventory;
use App\Models\ActivityLog;
use App\Events\OrderCreated;
use App\Events\OrderUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Http\Resources\OrderWithProductsResource;

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
      $customerKey = $request->get('customer_key');
      $status = Order::STATUS_REQUESTED;

      if($shippingAddress === NULL)
        $shippingAddress = $customer->street . ', ' . $customer->city . ' ' . $customer->zip . ', ' . $customer->country;
      if($customer->email_verified_at === NULL)
        $status = Order::STATUS_PENDING;

      $order = Order::create([
        'user_id' => $customer->id,
        'customer_key' => $customerKey,
        'order_status' => $status,
        'order' => json_decode($cart->cart),
        'shipping_method' => $shippingMethod,
        'shipping_address' => $shippingAddress,
        'shipping_date' => Carbon::parse($shippingDate),
        'pickup_location' => $pickupLocation,
        'note' => $shippingNote,
      ]);

      try {
        OrderCreated::dispatch($order);
      } catch(Exception $e) {
        Log::error("Order notification not dispatched properly: " . $e->getMessage());
        return back();
      }

      $cart->delete();
      return response('Order successfuly requested!', 200);
    }

    public function update(Request $request, $id)
    {
      $order = Order::find($id);
      $originalOrder = Order::where('id', $id)->get(['order_status', 'shipping_address', 'shipping_date', 'note', 'order_id', 'salesman_id'])->first()->toArray();
      $data = $request->only('order_status', 'order', 'shipping_address', 'shipping_date', 'note', 'order_id', 'salesman_id');
      ActivityLog::create([
        'user_id' => auth()->user()->id,
        'order_id' => $order->id,
        'from' => json_encode($originalOrder),
        'to' => json_encode($data)
      ]);
      $order->update($data);
      if((int) $data['order_status'] === Order::STATUS_ACCEPTED && (int) $originalOrder['order_status'] !== (int) $data['order_status']) {
        Email::create([
          'to' => env('MAIL_USERNAME'),
          'class' => 'App\Mail\OrderApproved',
          'order_id' => $order->id,
          'type' => Email::TYPE_SALESMAN,
        ]);
      }
      return back()->with('success', 'Order updated successfully!');
    }

    public function change(Request $request, $id)
    {
      $order = Order::find($id);
      ActivityLog::create([
        'user_id' => auth()->user()->id,
        'order_id' => $order->id,
        'from' => json_encode($order->order),
        'to' => json_encode($request->all())
      ]);
      $order->update(['order' => $request->all()]);
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
        Cart::create([
          'user_id' => $order->user->id,
          'cart' => json_encode($order->order)
        ]);
      }
      return redirect()->intended('/cart');
    }

    public function products($id)
    {
      $order = Order::find($id);
      return new OrderWithProductsResource($order);
    }

    public function notify($id)
    {
      $order = Order::find($id);
      OrderUpdated::dispatch($order);
      return back();
    }
}
