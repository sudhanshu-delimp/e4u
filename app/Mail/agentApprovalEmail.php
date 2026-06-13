<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class agentApprovalEmail extends Mailable
{
    use Queueable, SerializesModels;
    public  $body;


    public function __construct($body)
    {
         $this->body = $body;
    }

    
    public function build()
    {

        return $this->from(config('mail.from.address'))
                ->subject('Agent Approval Notification') 
                ->markdown('emails.agent.agent_approval_email')
                ->with('agent', $this->body);
    }
}
