<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Events\OrderUpdated;
use Illuminate\Http\Request;

class EmailController extends Controller
{
  public function notifyCustomer($id, Request $request)
  {
    $order = Order::find($id);
    OrderUpdated::dispatch($order, $request->get('remarks'));
    return back();
  }
}
