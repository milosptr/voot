<?php

namespace App\Listeners;

use App\Mail\CustomerRegistered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;

class SendCustomerRegistrationEmail
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Registered $event)
    {
      $recipient = isset($event->user->email) ? $event->user->email : 'milosptr@icloud.com';
      Mail::to($recipient)
        ->send(new CustomerRegistered($event->user));
    }
}
