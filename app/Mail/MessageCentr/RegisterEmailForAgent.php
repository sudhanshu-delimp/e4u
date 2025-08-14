<?php

namespace App\Mail\MessageCentr;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterEmailForAgent extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    protected $agentUser;
    public function __construct($user, $agentUser)
    {
        $this->user = $user;
        $this->agentUser = $agentUser;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.massage_center.email_for_agent')->with([
            'user' => $this->user,
            'agentUser' => $this->agentUser,
        ]);
    }
}
