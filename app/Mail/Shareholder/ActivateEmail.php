<?php

namespace App\Mail\Shareholder;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivateEmail extends Mailable
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
                ->subject('Shareholder Account Activation Notification') 
                ->markdown('emails.shareholder.activate_email')
                ->with('shareholder', $this->body);
    }
}
