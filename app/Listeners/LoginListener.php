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
        if(in_array('ipinfo', Route::current()->gatherMiddleware())) {


            $data = [
                'last_online_at' => $event->user->last_online_at,
                'user_id' => $event->user->id,
                'email' => ($event->user->email) ?? $event->user->phone,
                'ip_address' => @request()->ipinfo->ip,
                'device' => request()->userAgent(),
                'country' => @request()->ipinfo->country_name,
                'city' => @request()->ipinfo->city,
                'type' => 1,
            ];
            //echo "datetime = ".$data['last_online_at'];
            //dd($data['last_online_at']);
            LoginAttempt::Create($data);
        }

    }
}
