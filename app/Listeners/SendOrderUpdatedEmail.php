<?php

namespace App\Listeners;

use App\Events\OrderUpdated;
use App\Mail\OrderUpdated as OrderUpdatedEmail;
use Illuminate\Support\Facades\Mail;

class SendOrderUpdatedEmail
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OrderUpdated $event)
    {
      $recipient =  $event->order->user->invoice_email ?:  $event->order->user->email;
      Mail::to($recipient)
        ->send(new OrderUpdatedEmail($event->order));
    }
}
