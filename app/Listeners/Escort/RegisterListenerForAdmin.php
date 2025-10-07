<?php

namespace App\Listeners\Escort;

use App\Events\EscortRegister;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\RegisterEscort\RegisterEmailForAdmin;

class RegisterListenerForAdmin implements ShouldQueue
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
        Mail::to(config('common.contactus_admin_email'))->send(new RegisterEmailForAdmin($user));
		
    }
}
