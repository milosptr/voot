<?php

namespace App\Listeners;

use Exception;
use App\Events\OrderUpdated;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderUpdated as OrderUpdatedEmail;

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
      $email = explode(';', $event->order->user->email);
      $invoiceEmail = $event->order->user->invoice_email ? explode(';', $event->order->user->invoice_email) : [];
      $recipients = array_merge($email, $invoiceEmail);
      foreach ($recipients as $recipient) {
        try {
          Mail::to($recipient)->send(new OrderUpdatedEmail($event->order, $event->remarks));
          Log::info('Mail sent (OrderUpdated) to client for updated order #' . $event->order->id . ' to email address '. $recipient);
        } catch(Exception $e) {
          Log::error('Mail not sent to client for updated order #' . $event->order->id . ' to email address '. $recipient . ' '. $e->getMessage());
        }
      }
    }
}
