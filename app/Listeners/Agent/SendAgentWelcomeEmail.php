<?php

namespace App\Listeners\Agent;

use App\Events\AgentRegistered;

use App\Mail\Agent\AgentWelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendAgentWelcomeEmail implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     *
     * @return void
     */
   
    public function __construct()
    {
       
       
    }

    /**
     * Handle the event.
     *
     * @param  App\Events\Agentregistered  $event
     * @return void
     */
    public function handle(AgentRegistered $event)
    {
        
        Mail::to($event->agent['email'])->send(new AgentWelcomeMail($event->agent));
    }
}
