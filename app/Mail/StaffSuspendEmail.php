<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StaffSuspendEmail extends Mailable
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
                ->subject('Staff Suspension Notification') 
                ->markdown('emails.staff.staff_suspend_email')
                ->with('staff', $this->body);
    }
}
