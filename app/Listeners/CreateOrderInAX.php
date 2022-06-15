<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Services\LisaAxService;
use Illuminate\Support\Facades\Log;
use Exception;

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
      if(env('APP_ENV') === 'local' && $event->order->user->email_verified_at === NULL)
      return;

      Log::info('Requesting order #'.$event->order->id.' to AX');
      try {
        $response = LisaAxService::forCustomer($event->order->user)
          ->setBodyForOrderCreated($event->order)
          ->send();
        $orderId = LisaAxService::storeOrderId($response, $event->order);
        $event->order->update(['ax_status' => 1]);

        Log::info('Order #'.$event->order->id.' created successfully in AX: '. $orderId);
      } catch(Exception $e) {
        Log::error('Trying to create order #'.$event->order->id.' in AX: '. $e->getMessage());
        $event->order->update(['ax_status' => 0]);
      }
    }
}
