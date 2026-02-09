<?php

namespace App\Mail\Operator;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OperatorSuspendEmail extends Mailable
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
                ->subject('Operator Suspension Notification') 
                ->markdown('emails.operator.operator_suspend_email')
                ->with('operator', $this->body);
    }
}
