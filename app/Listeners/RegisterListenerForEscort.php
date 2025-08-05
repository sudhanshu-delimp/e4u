<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;
use App\Mail\RegisterEmailForEscort;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterListenerForEscort implements ShouldQueue
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
       Mail::to('admin@e4u.com.au')->send(new RegisterEmailForEscort());

       Log::info('third Queue for Escort');
    }
}
