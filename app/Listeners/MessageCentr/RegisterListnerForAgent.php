<?php

namespace App\Listeners\MessageCentr;


use App\Models\User;
use App\Events\MassageRegister;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\MessageCentr\RegisterEmailForAgent;

class RegisterListnerForAgent implements ShouldQueue
{
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
     * @param  \App\Events\MassageRegister  $event
     * @return void
     */
    public function handle(MassageRegister $event)
    {
        $user = $event->massage;
        
        if (!empty($user->agent_id)) {
            $agentUser = User::where('member_id', $user->agent_id)->select('id', 'email', 'phone', 'name')->first();
            if ($agentUser) {
                Mail::to($agentUser->email)->send(
                    new RegisterEmailForAgent($user, $agentUser)
                );
            }
        }
    }
}
