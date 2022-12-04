<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Events\OrderUpdated;
use App\Models\Email;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EmailController extends Controller
{
  public function notifyCustomer($id, Request $request)
  {
    $order = Order::find($id);
    OrderUpdated::dispatch($order, $request->get('remarks'));
    return back();
  }

  public function resendEmail($id)
  {
    $email = Email::find($id);
    try {
      Email::create([
        'to' => $email->to,
        'remark' => $email->remark,
        'order_id' => $email->order_id,
        'type' => $email->type,
        'class' => $email->class
      ]);
      $message = 'Tölvupóstur er sendur aftur til viðskiptavinar '. $email->to;
      return Redirect::to('/backend/settings/sent-emails')->with(['status' => $message, 'key' => $email->id]);
    } catch(Exception $e) {
      $message = 'Ekki er hægt að senda tölvupóst á '. ($email && isset($email->to) ? $email->to : '');
      return Redirect::to('/backend/settings/sent-emails')->with('ERROR', $message);
    }
  }
}
