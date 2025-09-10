<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Route;
use App\Models\LoginAttempt;

class LoginListener
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
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $loginAttempt = LoginAttempt::where([
            'user_id' => $event->user->id,
            'email'   => $event->user->email ?? $event->user->phone,
        ])->first();


        if ($loginAttempt) {
            $loginAttempt->login_count = $loginAttempt->login_count + 1;
            $loginAttempt->ip_address = request()->ip();
            $loginAttempt->device = request()->header('User-Agent');
            $loginAttempt->online = 'yes';
            $loginAttempt->type = 1;
            $loginAttempt->country =  null;
            $loginAttempt->city = null;
            $loginAttempt->save();
        } else {
            LoginAttempt::create([
                'user_id'       => $event->user->id,
                'email'         => $event->user->email ?? $event->user->phone,
                'type'          => 1,
                'ip_address'    => request()->ip(),
                'device'        => request()->header('User-Agent'),
                'online'        => 'yes',
                'country'       => null,
                'city'          => null,
                'login_count'   => 1,
            ]);
        }

    }
}
