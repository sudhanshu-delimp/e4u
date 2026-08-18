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
        View::composer('*', function ($view) {
            $count = 0;
            $datatable_entries = 25;

            if (auth()->check()) {

                $user = auth()->user();

                switch ($user->type) {
                    case '4':
                        $count = other_centre_support_notification_count();
                        $datatable_entries = $user->massage_settings->datatable_entries ?? 25;
                        break;

                    case '3':
                        $datatable_entries = $user->escort_settings->datatable_entries ?? 25;
                        break;

                    default:
                        $datatable_entries = 25;
                        break;
                }
            }

            $view->with([
                'other_centre_support_notification_count' => $count,
                'datatable_entries' => $datatable_entries,
            ]);
        });

        app()->instance('serverStartTime', now());

        if (!Cache::has('app_start_time')) {
            Cache::forever('app_start_time', now());
        }

        Paginator::useBootstrap();
    }
}
