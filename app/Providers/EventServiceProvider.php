<?php

namespace App\Providers;

use App\Events\EscortRegister;
use App\Events\AgentRegistered;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\Agent\SendAgentWelcomeEmail;
use App\Listeners\Escort\RegisterListenerForEscort;
use App\Listeners\Escort\RegisterListenerForAdmin;
use App\Listeners\Escort\RegisterListenerForAgent;
use App\Listeners\Agent\SendAdminAgentRegisteredEmail;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

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
            
        ],
        EscortRegister::class => [
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
