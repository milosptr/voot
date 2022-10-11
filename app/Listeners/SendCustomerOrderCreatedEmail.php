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
        $recipients = $event->order->user->invoice_email ? [$event->order->user->invoice_email]: explode(';', $event->order->user->email);
        foreach ($recipients as $recipient) {
          Mail::to($recipient)->send(new OrderCreatedMail($event->order, true));
        }
        Log::info('Email sent to addresses (SendCustomerOrderCreatedEmail)' . join(", ", $recipients));
      } catch(Exception $e) {
        Log::error('Mail not sent (SendCustomerOrderCreatedEmail) to client for order #'.$event->order->id);
      }
    }
}
