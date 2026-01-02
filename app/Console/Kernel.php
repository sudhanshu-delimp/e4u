<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Auth;
class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

    protected $commands = [
        Commands\EnableEscortProfile::class,
        Commands\DisableEscortProfile::class,
        Commands\PasswordSecurityReset::class,
        Commands\SendPlaymateProfileDeactivationNotification::class,
        Commands\SendPasswordExpiryNotifications::class
    ];

    /**
    * Define the application's command schedule.
    *
    * @param \Illuminate\Console\Scheduling\Schedule $schedule
    * @return void
    */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('disable_escort')->dailyAt('00:00')->timezone('Australia/Perth');//Based on the escort profile end date, set enable to 0
        $schedule->command('enable_escort')->dailyAt('00:05')->timezone('Australia/Perth');  //Based on the listing, add start-end date to escort profile and enable the profile
        $schedule->command('send:playmate_disable')->daily();
        $schedule->command('send:playmate_disable')->daily();
        $schedule->command('passwords:send-expiry-notices')->dailyAt('10:00')->timezone('Australia/Perth');
        $schedule->command('escort:send-listing-expiry-reminders')->dailyAt('00:00')->timezone('Australia/Perth');
        $schedule->command('appointments:update-status')->everySixHours();
        $schedule->command('center-notification:expire-check')->dailyAt('00:00')->timezone('Australia/Perth');
        //$schedule->command('resetPassword')->daily();
    }
    // protected function schedule(Schedule $schedule)
    // {
    //     // $schedule->command('inspire')->hourly();
    // }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
