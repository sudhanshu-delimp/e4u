<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use PDF;

class PaymentMailer extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;


    public $template;
    public $data;
    public $subjectLine;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($template, $data = [], $subject = null)
    {
        $this->template = $template;
        $this->data = $data;
        $this->subjectLine = $subject;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $pdf = PDF::loadView(
            'escort.dashboard.Bookkeeping.modal.transaction-summary',
            [
                'payment' => $this->data['payment'],
                'print' => true,
            ]
        );

        return $this
            ->subject($this->subjectLine ?? 'Payment Notification')
            ->view($this->template)
            ->with($this->data)
            ->attachData(
                $pdf->output(),
                'payment-' . str_replace(' ', '_', $this->data['payment']->service) . '_' . $this->data['payment']->ref_no . '.pdf',
                [
                    'mime' => 'application/pdf'
                ]
            );
    }
}
