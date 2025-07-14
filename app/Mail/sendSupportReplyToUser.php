<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendSupportReplyToUser extends Mailable
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
         $email = $this->subject('Support Ticket Reply : Escorts4u')
                  ->from(env('MAIL_FROM_ADDRESS'))
                  ->view('emails.sendSupportReplyToUser')
                  ->with(['body' => $this->data]);
        
    }
}
