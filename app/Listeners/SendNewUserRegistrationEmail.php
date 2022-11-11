<?php

namespace App\Listeners;

use App\Mail\UserRegistered;
use App\Models\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Log;

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
      $defaultRecipients = isset($config['value']) ? explode(';', $config['value']) : ['milosptr@icloud.com'];
      try {
        foreach ($defaultRecipients as $recipient) {
          if(!empty($recipient)) {
            Mail::to($recipient)
              ->send(new UserRegistered($event->user));
          }
        }
      } catch (\Throwable $th) {
        Log::error('SendNewUserRegistrationEmail error: '. $th->getMessage());
      }
    }
}
