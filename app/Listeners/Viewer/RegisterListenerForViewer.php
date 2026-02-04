<?php

namespace App\Listeners\Viewer;

use App\Events\ViewerRegister;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\NewUserRegistrationConfirmation;
use App\Mail\RegisterEmailForViewer;
use Illuminate\Auth\Events\Registered;

class RegisterListenerForViewer
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
     * @param  \App\Events\ViewerRegister  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $user = $event->user;
        Mail::to($user->email)->send(new RegisterEmailForViewer($user));
        Mail::to($user->email)->later(now()->addSeconds(5), new NewUserRegistrationConfirmation($user));
    }
}
