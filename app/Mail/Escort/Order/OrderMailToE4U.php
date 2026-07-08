<?php

namespace App\Mail\Escort\Order;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMailToE4U extends Mailable
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
    return $this->subject("Order Confirmation Products – Member ID: {$this->data['member_id']} | Order Ref: {$this->data['id']}")->view('emails.escort.order.order_mail_to_e4u')
      ->with(['data' => $this->data]);  
  }
}
