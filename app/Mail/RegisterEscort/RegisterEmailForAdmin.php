<?php

namespace App\Mail\RegisterEscort;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterEmailForAdmin extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public $user;
     public function __construct($user)
    {
        $this->user = $user;
    }
      
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.escort.email_for_admin')->with([
            'user' => $this->user,
        ]);;
        
    }
}
