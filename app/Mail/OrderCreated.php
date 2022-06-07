<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCreated extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    public $isCustomer;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, $isCustomer = false)
    {
        $this->order = $order;
        $this->isCustomer = $isCustomer;
    }

    public function setCustomer($bool)
    {
      $this->isCustomer = $bool;
      return $this;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.order-created', compact(['isCustomer' => $this->isCustomer]));
    }
}
