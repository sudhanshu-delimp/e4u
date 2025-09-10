<?php

namespace App\Providers;

use App\Events\EscortRegister;
use App\Events\AgentRegistered;
use App\Events\MassageRegister;
use App\Listeners\LoginListener;
use App\Listeners\LogoutListener;
use Illuminate\Support\Facades\Event;
use App\Listeners\LoginFailedListener;
use Illuminate\Auth\Events\Registered;
use App\Listeners\Agent\SendAgentWelcomeEmail;
use App\Listeners\CreateDefaultAccountSettings;
use App\Listeners\Escort\RegisterListenerForAdmin;
use App\Listeners\Escort\RegisterListenerForAgent;
use App\Listeners\Escort\RegisterListenerForEscort;
use App\Listeners\Agent\SendAdminAgentRegisteredEmail;
use App\Listeners\MessageCentr\RegisterListnerForAdmin;
use App\Listeners\MessageCentr\RegisterListnerForAgent;
use App\Listeners\MessageCentr\RegisterListnerForMassageCentr;
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
            CreateDefaultAccountSettings::class,
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
        MassageRegister::class => [
            RegisterListnerForMassageCentr::class,
            RegisterListnerForAgent::class,
            RegisterListnerForAdmin::class,
        ],
       
        'Illuminate\Auth\Events\Login' => [
            LoginListener::class
        ],
        'Illuminate\Auth\Events\Logout' => [
            LogoutListener::class,
        ],
        'Illuminate\Auth\Events\Failed' => [
            LoginFailedListener::class,
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
