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
        $ip = request()->ip() ?? (optional(request()->ipinfo)->ip);
        $device = request()->userAgent();
        $country = optional(request()->ipinfo)->country_name;
        $city = optional(request()->ipinfo)->city;
        
        $data = [
            'email' => ($event->credentials['email']) ?? ($event->credentials['phone'] ?? null),
            'ip_address' => $ip,
            'device' => $device,
            'country' => $country,
            'city' => $city,
            'type' => 0,
        ];

        LoginAttempt::Create($data);
    }
}
