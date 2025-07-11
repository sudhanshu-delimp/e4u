<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendSupportTicketConfirmationToUser extends Mailable
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

         $email = $this->subject('Confirmation Support Ticket')
                  ->from(env('MAIL_FROM_ADDRESS'))
                  ->view('emails.sendSupportTicketConfirmationToUser')
                  ->with(['body' => $this->data]);

        if (!empty($this->data['file_path']) && Storage::disk('support_tickets')->exists($this->data['file_path'])) {
        $email->attach(Storage::disk('support_tickets')->path($this->data['file_path']));
        }   

       
    }
}
