<?php

namespace App\Listeners\Escort;

use App\Events\EscortRegister;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\RegisterEscort\RegisterEmailForEscort;

class RegisterListenerForEscort
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
        $user = $event->escode;
        Mail::to($user->email)->send(new RegisterEmailForEscort($user));
    }
}
