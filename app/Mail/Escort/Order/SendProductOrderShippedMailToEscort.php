<?php

namespace App\Mail\Escort\Order;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendProductOrderShippedMailToEscort extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected array $data;

  public function __construct(array $data)
  {
    $this->data = $data;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    $subject = "Your Product Order Has Been Dispatched – Member ID: {$this->data['member_id']} | Order Ref: {$this->data['id']} | Delivery Address: {$this->data['delivery_address']}";
    return $this->subject($subject)->view('emails.escort.order.order_shipped_escort')
      ->with(['data' => $this->data]);
  }
}
