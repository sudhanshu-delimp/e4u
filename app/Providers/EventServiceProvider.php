<?php

namespace App\Providers;

use App\Events\AgentRegistered;
use App\Listeners\Agent\SendAdminAgentRegisteredEmail;
use App\Listeners\Agent\SendAgentWelcomeEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Listeners\RegisterListenerForAdmin;
use App\Listeners\RegisterListenerForEscort;
use App\Listeners\RegisterListenerForAgent;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            RegisterListenerForEscort::class,
            RegisterListenerForAdmin::class,
            RegisterListenerForAgent::class
        ],
        AgentRegistered::class => [
            SendAgentWelcomeEmail::class,
            SendAdminAgentRegisteredEmail::class
        ],
        'Illuminate\Auth\Events\Login' => [
            'App\Listeners\LoginListener',
        ],
        'Illuminate\Auth\Events\Logout' => [
            'App\Listeners\LogoutListener',
        ],
        'Illuminate\Auth\Events\Failed' => [
            'App\Listeners\LoginFailedListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
