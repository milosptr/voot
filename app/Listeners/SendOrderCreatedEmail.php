<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Mail\OrderCreated as OrderCreatedMail;
use App\Models\Config;
use Illuminate\Support\Facades\Mail;

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
      $config = Config::where('key', 'order_recipients')->orderBy('id', 'DESC')->get()->first();
      $recipient = isset($config['value']) ? $config['value'] : 'milosptr@icloud.com';
      Mail::to($recipient)
        ->send(new OrderCreatedMail($event->order));
    }
}
