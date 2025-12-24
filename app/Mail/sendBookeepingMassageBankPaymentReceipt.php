<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendBookeepingMassageBankPaymentReceipt extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
 
    public function __construct($data)
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
        // email_for_change_bank_pin
        return $this->from(env('MAIL_FROM_ADDRESS'))
            ->markdown('emails.massage_center.bookeeping_email_for_bank_payment_receipt')
            ->subject($this->data['subject'])
            ->with('body',$this->data);
    }
}
