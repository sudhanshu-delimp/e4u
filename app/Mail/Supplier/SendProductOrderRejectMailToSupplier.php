<?php

namespace App\Mail\Supplier;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendProductOrderRejectMailToSupplier extends Mailable
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
    $subject = "Product Order Has Been Rejected – Member ID: {$this->data['member_id']} | Order Ref: {$this->data['communication_id']}";
    return $this->subject($subject)->view('emails.escort.order.order_rejected_supplier')
      ->with(['data' => $this->data]);
  }
}
