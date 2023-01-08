<?php

namespace App\Mail;

use App\Models\Order;
use App\Traits\ProductTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderApproved extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
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
      $isCustomer = false;
      $subject = 'Pöntun samþykkt ' . $this->order->user->name . ' #' . $this->order->id;
      $categories = ProductTrait::parseSortedProductsByCategory($this->order);
      return $this->subject($subject)->view('emails.order-created', compact('isCustomer', 'categories'));
    }
}
