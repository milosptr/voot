<?php

namespace App\Listeners;

use Exception;
use App\Models\Email;
use App\Models\Config;
use App\Events\OrderCreated;
use Illuminate\Support\Facades\Log;

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
        $defaultRecipients = isset($config['value']) ? explode(';', $config['value']) : ['milosptr@icloud.com'];
        $salesmans = $event->order->user->salesman->pluck('email')->all();
        $salesmans = is_array($salesmans) ? $salesmans : [];
        $recipients = array_merge($salesmans, $defaultRecipients);

        foreach ($recipients as $recipient) {
          if(!empty($recipient)) {
            Email::create([
              'to' => $recipient,
              'class' => 'App\Mail\OrderCreated',
              'order_id' => $event->order->id,
              'type' => 2,
            ]);
          }
        }
      } catch(Exception $e) {
        Log::error('Mail not sent (SendOrderCreatedEmail) to client for order #'.$event->order->id . ' '. $e->getMessage());
      }
    }
}
