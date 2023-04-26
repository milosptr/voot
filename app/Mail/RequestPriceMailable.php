<?php

namespace App\Mail;

use stdClass;
use App\Models\Order;
use App\Models\RequestPrice;
use App\Traits\ProductTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestPriceMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(RequestPrice $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Viðskiptavinur óskar eftir verði ' . $this->order->name;
        $order = new stdClass;
        $order->order = json_decode($this->order->order, true);
        $categories = ProductTrait::parseSortedProductsByCategory($order);
        return $this->subject($subject)->view('emails.price-request', compact('categories'));
    }
}
