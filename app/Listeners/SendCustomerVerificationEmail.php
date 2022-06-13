<?php

namespace App\Listeners;

use App\Events\UserVerified;
use App\Mail\UserVerified as MailUserVerified;
use Illuminate\Support\Facades\Mail;

class SendCustomerVerificationEmail
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserVerified $event)
    {
      Mail::to($event->user->email)
        ->send(new MailUserVerified($event->user));
    }
}
