<?php

namespace App\Listeners;

use Exception;
use App\Events\RequestPriceEvent;
use App\Mail\RequestPriceMailable;
use App\Models\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendRequestPriceEmail
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(RequestPriceEvent $event)
    {
        try {
            $recipients = Config::where('key', 'price_request')->first();
            if($recipients) {
                $recipients = explode(',', $recipients->value);
            } else {
                $recipients = ['hordur@voot.is'];
            }
            $recipients[] = $event->order->email;

            foreach($recipients as $recipient) {
                Mail::to($recipient)->send(new RequestPriceMailable($event->order));
                Log::info('Mail sent (SendRequestPriceEmail) to '.$recipient.' for order #'.$event->order->id);
            }
        } catch(Exception $e) {
            Log::error('Mail not sent (SendRequestPriceEmail) to salesman for order #'.$event->order->id . ' '. $e->getMessage());
        }
    }
}
