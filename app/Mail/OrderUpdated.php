<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderUpdated extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    public $remarks;
    public $isCustomer;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, $remarks = '')
    {
        $this->order = $order;
        $this->remarks = $remarks;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      $subject = 'Your order is updated';
      $remarks = $this->remarks;
      return $this->subject($subject)->view('emails.order-updated', compact('remarks'));
    }
}
