<?php

namespace App\Events;

use App\Models\RequestPrice;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class RequestPriceEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(RequestPrice $order)
    {
        $this->order = $order;
    }
}
