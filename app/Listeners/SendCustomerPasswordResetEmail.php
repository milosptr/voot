<?php

namespace App\Listeners;

use App\Events\UserPasswordReset;
use App\Mail\UserPasswordReset as MailUserPasswordReset;
use Illuminate\Support\Facades\Mail;

class SendCustomerPasswordResetEmail
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserPasswordReset $event)
    {
      Mail::to($event->user->email)
        ->send(new MailUserPasswordReset($event->user, $event->password));
    }
}
