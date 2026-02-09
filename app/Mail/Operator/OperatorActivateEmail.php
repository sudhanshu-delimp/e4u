<?php

namespace App\Mail\Operator;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OperatorActivateEmail extends Mailable
{
    use Queueable, SerializesModels;
    public  $body;

    public function __construct($body)
    {
         $this->body = $body;
    }

    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
                ->subject('Operator Account Activation Notification') 
                ->markdown('emails.operator.operator_activate_email')
                ->with('operator', $this->body);
    }
}
