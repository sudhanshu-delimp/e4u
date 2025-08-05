<?php

namespace App\Listeners;

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
        Mail::to('admin@e4u.com.au')->send(new RegisterEmailForAgent());

        Log::info('second Queue for Agent');
    }
}
