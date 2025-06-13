<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RepositoryServiceProvider::class);
         // Include all php files from Helpers directory
        foreach (glob(app()->path() . '/Helpers/*.php') as $file) {
            require_once($file);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        app()->instance('serverStartTime', now());

        if (!Cache::has('app_start_time')) {
            Cache::forever('app_start_time', now());
        }
        
        Paginator::useBootstrap();
    }
}
