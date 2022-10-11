<?php

namespace App\Listeners;

use Exception;
use App\Models\Config;
use App\Events\OrderCreated;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderCreated as OrderCreatedMail;

class SendOrderCreatedEmail
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
        $config = Config::where('key', 'order_recipients')->orderBy('id', 'DESC')->get()->first();
        $recipients = isset($config['value']) ? explode(';', $config['value']) : ['milosptr@icloud.com'];
        foreach ($recipients as $recipient) {
          Mail::to($recipient)
          ->send(new OrderCreatedMail($event->order));
        }
        Log::info('Email sent to addresses (SendOrderCreatedEmail) ' . join(", ", $recipients));
      } catch(Exception $e) {
        Log::error('Mail not sent (SendOrderCreatedEmail) to client for order #'.$event->order->id);
      }
    }
}
