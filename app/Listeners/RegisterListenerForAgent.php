<?php

namespace App\Listeners;

use App\Models\User;
use App\Mail\RegisterEmailForAdmin;
use App\Mail\RegisterEmailForAgent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterListenerForAgent implements ShouldQueue
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
     * @param  App\Events\Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
       
        $user = $event->user;
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
