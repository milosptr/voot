<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Services\LisaAxService;
use Exception;
use Illuminate\Support\Facades\Log;

class CreateOrderInAX
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
      if(env('APP_ENV') === 'local')
        return;

      Log::info('Requesting order #'.$event->order->id.' to AX');
      try {
        $response = LisaAxService::forCustomer($event->order->user)
          ->setBodyForOrderCreated($event->order)
          ->send();
        Log::info('Order #'.$event->order->id.' created successfully in AX: '. json_encode($response));
      } catch(Exception $e) {
        Log::error('Trying to create order #'.$event->order->id.' in AX: '. $e->getMessage());
        $event->order->update(['ax_status' => 0]);
      }
    }
}
