<?php

namespace App\Mail\Escort\Order;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use PDF;

class OrderMailToEscort extends Mailable
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

    $pdf = PDF::loadView(
        'partials.common.tax-invoice',
        [
            'payment' => $this->data['payment'],
            'print' => true,
        ]
    );

    return $this->subject("Your Product Order Has Been Placed – Member ID: {$this->data['member_id']} | Order Ref: {$this->data['communication_id']}")->view('emails.escort.order.order_mail_to_escort')
      ->with(['data' => $this->data])
      ->attachData(
                $pdf->output(),
                'payment-' . str_replace(' ', '_', $this->data['payment']->service) . '_' . $this->data['payment']->ref_no . '.pdf',
                [
                    'mime' => 'application/pdf'
                ]
            ); // <-- Pass to view
  }
}
