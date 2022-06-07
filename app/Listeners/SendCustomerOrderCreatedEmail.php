<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Mail\OrderCreated as OrderCreatedMail;
use App\Models\Config;
use Illuminate\Support\Facades\Mail;

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
      $recipient = $event->order->user->email;
      Mail::to($recipient)
        ->send(new OrderCreatedMail($event->order, true));
    }
}
