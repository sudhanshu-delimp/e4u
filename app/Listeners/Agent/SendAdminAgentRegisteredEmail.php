<?php

namespace App\Listeners\Agent;

use App\Events\AgentRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\Agent\AdminAgentRegisteredMail;
use Illuminate\Support\Facades\Mail;

class SendAdminAgentRegisteredEmail implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  App\Events\AgentRegistered  $event
     * @return void
     */
    public function handle(AgentRegistered $event)
    {

       
        Mail::to(config('common.contactus_admin_email'))->send(new AdminAgentRegisteredMail($event->agent));
    }
}
