<?php

namespace App\Listeners;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Events\ForgotPassword as ForgotPasswordEvent;
use App\Mail\ForgotPassword;

class SendForgotPasswordEmail
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ForgotPasswordEvent $event)
    {
      try {
        Mail::to($event->user->email)->send(new ForgotPassword($event->user));
        Log::info('Mail sent (ForgotPassword) to client email address '. $event->user->email);
      } catch(Exception $e) {
        Log::error('Mail not sent (ForgotPassword) to client email address '. $event->user->email . ' '. $e->getMessage());
      }
    }
}
