<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/';
    public const EscortDashboard = '/escort-dashboard';
    public const AgentDashboard = '/agent-dashboard';
    public const AdminDashboard = '/admin-dashboard';
    //public const MassageDashboard = '/center-dashboard';
    public const Dashboard = '/dashboard';

    public const EscortList = '/all-escorts-list';
    public const staffDashboard = '/staff-dashboard';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::prefix('admin-dashboard')
                ->middleware(['web', 'admin','TrackLoginUserInfo'])
                ->namespace('App\Http\Controllers\Admin')
                ->group(base_path('routes/admin.php'));

            Route::prefix('escort-dashboard')
                ->middleware(['web', 'escort', 'HeaderInfo','TrackLoginUserInfo'])
                ->namespace('App\Http\Controllers\Escort')
                ->group(base_path('routes/escort.php'));

            Route::prefix('/')
                ->middleware(['web', 'user', 'HeaderInfo','TrackLoginUserInfo'])
                //->namespace('App\Http\Controllers\User')
                ->group(base_path('routes/web.php'));

            Route::prefix('agent-dashboard')
                ->middleware(['web', 'agent', 'HeaderInfo','TrackLoginUserInfo'])
                ->namespace('App\Http\Controllers\Agent')
                ->group(base_path('routes/agent.php'));

            Route::prefix('center-dashboard')
                ->middleware(['web', 'center', 'HeaderInfo','TrackLoginUserInfo'])
                ->namespace('App\Http\Controllers\Center')
                ->group(base_path('routes/center.php'));

            Route::middleware(['web','TrackLoginUserInfo'])
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            Route::middleware('dev')
                ->namespace('App\Http\Controllers\Dev')
                ->group(base_path('routes/dev.php'));
             Route::prefix('staff-dashboard')
                ->middleware(['web', 'staff', 'HeaderInfo','TrackLoginUserInfo'])
                ->namespace('App\Http\Controllers\Staff')
                ->group(base_path('routes/staff.php'));    
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
