<?php

namespace App\Listeners\MessageCentr;

use App\Events\MassageRegister;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\MessageCentr\RegisterEmailForAdmin;

class RegisterListnerForAdmin implements ShouldQueue
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
        Mail::to(config('common.contactus_admin_email'))->send(new RegisterEmailForAdmin($user));
    }
}
