<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

   
    public function boot()
    {

        View::composer('*', function ($view) {
            if (Auth::check()) {
                $userId = Auth::id();

                $alert_notifications = Notification::where([
                    'to_user' => $userId,
                    'notification_listing_type' => '2',
                ])->latest()->take(5)->get();

                $support_notifications = Notification::where([
                    'to_user' => $userId,
                    'notification_listing_type' => '1',
                ])->latest()->take(5)->get();

                $view->with('alert_notifications', $alert_notifications);
                $view->with('support_notifications', $support_notifications);
            } else {
                $view->with('alert_notifications', []);
                $view->with('support_notifications', []);
            }
        });

       
    }
}
