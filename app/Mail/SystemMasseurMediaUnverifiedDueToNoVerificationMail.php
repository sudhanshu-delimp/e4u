<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SystemMasseurMediaUnverifiedDueToNoVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $body;
    public function __construct($body)
    {
       $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         return $this->subject('Media Verification Status')->view('emails.system_masseur_media_unverified_due_to_no_verification')->with([
            'body' => $this->body,
        ]);
    }
}
