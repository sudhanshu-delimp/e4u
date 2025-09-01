<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\BaseRepositoryInterface',
            'App\Repositories\BaseRepository'
        );
        $this->app->bind(
            'App\Repositories\MassageProfile\MassageMediaInterface',
            'App\Repositories\MassageProfile\MassageMediaRepository'
        );
        $this->app->bind(
            'App\Repositories\MassageProfile\MassageProfileInterface',
            'App\Repositories\MassageProfile\MassageProfileRepository'
        );
        $this->app->bind(
            'App\Repositories\MassageProfile\MassageAvailabilityInterface',
            'App\Repositories\MassageProfile\MassageAvailabilityRepository'
        );

        $this->app->bind(
            'App\Repositories\PageCategory\PageCategoryInterface',
            'App\Repositories\PageCategory\PageCategoryRepository'
        );

        $this->app->bind(
            'App\Repositories\Page\PageInterface',
            'App\Repositories\Page\PageRepository'
        );
        $this->app->bind(
            'App\Repositories\Tour\TourInterface',
            'App\Repositories\Tour\TourRepository'
        );

        $this->app->bind(
            'App\Repositories\User\UserInterface',
            'App\Repositories\User\UserRepository'
        );
        $this->app->bind(
            'App\Repositories\Message\MessageInterface',
            'App\Repositories\Message\MessageRepository'
        );
        $this->app->bind(
            'App\Repositories\Review\ReviewInterface',
            'App\Repositories\Review\ReviewRepository'
        );

        $this->app->bind(
            'App\Repositories\Escort\EscortInterface',
            'App\Repositories\Escort\EscortRepository'
        );
        $this->app->bind(
            'App\Repositories\Agent\AgentEscortInterface',
            'App\Repositories\Agent\AgentEscortRepository'
        );
        $this->app->bind(
            'App\Repositories\Agent\AgentInterface',
            'App\Repositories\Agent\AgentRepository'
        );
        $this->app->bind(
            'App\Repositories\AgentBank\AgentBankDetailInterface',
            'App\Repositories\AgentBank\AgentBankDetailRepository'
        );
        $this->app->bind(
            'App\Repositories\EscortBank\EscortBankDetailInterface',
            'App\Repositories\EscortBank\EscortBankDetailRepository'
        );
        $this->app->bind(
            'App\Repositories\Escort\AvailabilityInterface',
            'App\Repositories\Escort\AvailabilityRepository'
        );

        $this->app->bind(
            'App\Repositories\Country\CountryInterface',
            'App\Repositories\Country\CountryRepository'
        );
        $this->app->bind(
            'App\Repositories\City\CityInterface',
            'App\Repositories\City\CityRepository',
        );
        $this->app->bind(
            'App\Repositories\State\StateInterface',
            'App\Repositories\State\StateRepository',
        );

        $this->app->bind(
            'App\Repositories\Service\ServiceInterface',
            'App\Repositories\Service\ServiceRepository'
        );

        $this->app->bind(
            'App\Repositories\ServiceCategory\ServiceCategoryInterface',
            'App\Repositories\ServiceCategory\ServiceCategoryRepository'
        );

        $this->app->bind(
            'App\Repositories\Escort\EscortMediaInterface',
            'App\Repositories\Escort\EscortMediaRepository'
        );

        $this->app->bind(
            'App\Repositories\Thumbnail\ThumbnailInterface',
            'App\Repositories\Thumbnail\ThumbnailRepository'
        );

        $this->app->bind(
            'App\Repositories\Duration\DurationInterface',
            'App\Repositories\Duration\DurationRepository'
        );

        $this->app->bind(
            'App\Repositories\AttemptLogin\AttemptLoginInterface',
            'App\Repositories\AttemptLogin\AttemptLoginRepository'
        );

        $this->app->bind(
            'App\Repositories\Playmate\PlaymateInterface',
            'App\Repositories\Playmate\PlaymateRepository'
        );
        $this->app->bind(
            'App\Repositories\Pricing\PricingInterface',
            'App\Repositories\Pricing\PricingRepository'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
