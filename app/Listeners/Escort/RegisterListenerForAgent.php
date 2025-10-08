<?php

namespace App\Listeners\Escort;

use App\Models\User;
use App\Events\EscortRegister;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\RegisterEscort\RegisterEmailForAgent;

class RegisterListenerForAgent implements ShouldQueue
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
     * @param  \App\Events\EscortRegister  $event
     * @return void
     */
    public function handle(EscortRegister $event)
    {
        $user = $event->escort;
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
