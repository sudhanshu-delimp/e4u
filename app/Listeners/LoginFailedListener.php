<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Failed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Route;
use App\Models\LoginAttempt;

class LoginFailedListener
{
    protected $attempt;
    /**
     * Create the event listener.
     *
     * @return void
     */

    public function __construct(LoginAttempt $attempt)
    {
        $this->attempt = $attempt;
    }

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Failed  $event
     * @return void
     */
    public function handle(Failed $event)
    {

        if(in_array('ipinfo', Route::current()->gatherMiddleware())) {

            $data = [
                'email' => ($event->credentials['email']) ?? $event->credentials['phone'] ,
                'ip_address' => request()->ipinfo->ip,
                'device' => request()->userAgent(),
                'country' => @request()->ipinfo->country_name,
                'city' => @request()->ipinfo->city,
                'type' => 0,
                //'last_online_at' => $event->user->last_online_at,
                //'user_id' => $event->user->id,
            ];

            LoginAttempt::Create($data);
        }
    }
}
