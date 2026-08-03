<?php

namespace App\Mail\Agent;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AgentMonthlyFeeEmail extends Mailable implements ShouldQueue
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
            ->subject('Agent Monthly Fee Report')
            ->markdown('emails.agent.agent_monthly_fee')
            ->with('agent', $this->body);
    }
}
