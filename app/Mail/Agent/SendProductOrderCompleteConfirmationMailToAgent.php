<?php

namespace App\Mail\Agent;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendProductOrderCompleteConfirmationMailToAgent extends Mailable
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
    $subject = "Order Successfully Completed on Behalf of Escort – Member ID: {$this->data['member_id']} | Order Ref: {$this->data['id']} | Delivery Address: {$this->data['delivery_address']}";
    return $this->subject($subject)->view('emails.escort.order.order_completed_agent')
      ->with(['data' => $this->data]);
  }
}
