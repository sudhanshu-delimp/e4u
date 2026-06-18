<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('*', function ($view) 
        {
            
            $count = 0;
            if (auth()->check() && auth()->user()->type == '4') {
                $count = other_centre_support_notification_count();
            }

            $view->with('other_centre_support_notification_count', $count);

        });
        
    
        app()->instance('serverStartTime', now());

        if (!Cache::has('app_start_time')) {
            Cache::forever('app_start_time', now());
        }
        
        Paginator::useBootstrap();
    }
}
