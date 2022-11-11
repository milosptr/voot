<?php

namespace App\Listeners;

use App\Events\UserVerified;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserVerified as MailUserVerified;

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
      try {
        Mail::to($event->user->email)
          ->send(new MailUserVerified($event->user));
      } catch (\Throwable $th) {
        Log::error('SendNewUserRegistrationEmail error: '. $th->getMessage());
      }
    }
}
