<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;
    // public $from;
    // public $subject;
    // public $data;
    //public $sendUrl;
    public $body;
    

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($body)
    {
        // $this->from = $from;
        // $this->subject = $subject;
        // $this->data = $data;
        $this->body = $body;
        //$this->sendUrl = $sendUrl;
      
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
        ->markdown('emails.confirmation')->with('body',$this->body);
    }
}
