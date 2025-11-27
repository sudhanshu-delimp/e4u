<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserStatusUpdatedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $statusName;
    public $statusMessage;
    public $emailType;


public function __construct($user, $statusName, $statusMessage, $emailType = null)
{
    $this->user = $user;
    $this->statusName = $statusName;
    $this->statusMessage = $statusMessage;
    $this->emailType = $emailType ?? ''; // default empty string
}

    public function build()
    {
        return $this->subject('Account Status Notification')
            ->view('emails.user_status_updated');
    }
}
