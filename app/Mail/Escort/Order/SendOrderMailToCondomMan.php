<?php

namespace App\Mail\Escort\Order;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendOrderMailToCondomMan extends Mailable
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
    return $this->subject("New Product Order for Fulfillment – Member ID: {$this->data['member_id']} | Order Ref: {$this->data['communication_id']}")->view('emails.escort.order.order_mail_to_condom_man')
      ->with(['data' => $this->data]); // <-- Pass to view
  }
}
