<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendPlaymateAccountDisableMail extends Mailable
{
    use Queueable, SerializesModels;


    public $subject = 'Playmate deactivate notification';
    public $body;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($body)
    {
         //$this->subject = $subject;
         $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
            ->markdown('emails.PlaymateDisable')
            ->subject($this->subject)
            ->with('body',$this->body);
    }
}
