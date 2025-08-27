<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPasswordExpiryReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     public $user;
     public $days;
     public $expiryDate;
     
    public function __construct($user, $days, $expiryDate)
    {
        $this->user = $user;
        $this->days = $days;
        $this->expiryDate = $expiryDate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.password_expiry_reminder')->with([
            'user' => $this->user,
            'days' => $this->days,
            'expiryDate' => $this->expiryDate
        ]);
    }
}
