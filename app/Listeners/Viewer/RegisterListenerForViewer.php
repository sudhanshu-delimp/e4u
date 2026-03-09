<?php

namespace App\Listeners\Viewer;

use App\Events\ViewerRegister;
use App\Mail\NewUserRegistrationConfirmation;
use App\Mail\NewUserRegistrationConfirmationToAdmin;
use App\Mail\RegisterEmailForViewer;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

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
        Mail::to(config('common.contactus_admin_email'))->later(now()->addSeconds(5), new NewUserRegistrationConfirmationToAdmin($user));
    }
}
