<?php

namespace App\Mail\Operator;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OperatorApprovalEmail extends Mailable
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
                ->subject('Operator Approval Notification') 
                ->markdown('emails.staff.operator_approval_email')
                ->with('staff', $this->body);
    }
}
