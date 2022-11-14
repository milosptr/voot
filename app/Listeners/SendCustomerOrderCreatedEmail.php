<?php

namespace App\Listeners;

use Exception;
use App\Events\OrderCreated;
use Illuminate\Support\Facades\Log;
use App\Models\Email;

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
        $email = explode(';', $event->order->user->email);
        $invoiceEmail = $event->order->user->invoice_email ? explode(';', $event->order->user->invoice_email) : [];
        $recipients = array_merge($email, $invoiceEmail);
        foreach ($recipients as $recipient) {
          if(!empty($recipient)) {
            Email::create([
              'to' => $recipient,
              'class' => 'App\Mail\OrderCreatedCustomer',
              'order_id' => $event->order->id,
              'type' => 1,
            ]);
          }
        }
      } catch(Exception $e) {
        Log::error('Mail not sent (SendCustomerOrderCreatedEmail) to client for order #'.$event->order->id. ' '. $e->getMessage());
      }
    }
}
