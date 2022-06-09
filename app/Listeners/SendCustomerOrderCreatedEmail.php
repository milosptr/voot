<?php

namespace App\Listeners;

use Exception;
use App\Models\Config;
use App\Events\OrderCreated;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderCreated as OrderCreatedMail;

class SendCustomerOrderCreatedEmail
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
      try {
        $recipient = $event->order->user->email;
        Mail::to($recipient)
          ->send(new OrderCreatedMail($event->order, true));
      } catch(Exception $e) {
        Log::error('Mail not sent to client for order #'.$event->order->id);
      }
    }
}
