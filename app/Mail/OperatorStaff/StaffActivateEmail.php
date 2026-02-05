<?php

namespace App\Mail\OperatorStaff;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StaffActivateEmail extends Mailable
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
                ->subject('Operator Staff Account Activation Notification') 
                ->markdown('emails.operator_staff.staff_activate_email')
                ->with('staff', $this->body);
    }
}
