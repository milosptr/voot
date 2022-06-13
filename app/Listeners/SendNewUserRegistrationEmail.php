<?php

namespace App\Listeners;

use App\Mail\UserRegistered;
use App\Models\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;

class SendNewUserRegistrationEmail
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Registered $event)
    {
      $config = Config::where('key', 'order_recipients')->orderBy('id', 'DESC')->get()->first();
      $recipient = isset($config['value']) ? $config['value'] : 'milosptr@icloud.com';
      Mail::to($recipient)
        ->send(new UserRegistered($event->user));
    }
}
