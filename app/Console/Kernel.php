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
        Commands\SendPasswordExpiryNotifications::class,
        Commands\DbBackEndProcess::class,
        Commands\SyncMassageProfile::class,
        Commands\MassageMediaExpireCron::class, 
        Commands\MasseurMediaExpireCron::class,  
        Commands\EscortsMediaExpireCron::class,
        Commands\CleanPdfBatches::class,
    ];

    /**
    * Define the application's command schedule.
    *
    * @param \Illuminate\Console\Scheduling\Schedule $schedule
    * @return void
    */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('sync_escort')->everyMinute();
        $schedule->command('passwords:send-expiry-notices')->dailyAt('10:00')->timezone('Australia/Perth');
        $schedule->command('escort:send-listing-expiry-reminders')->dailyAt('00:00')->timezone('Australia/Perth');
        $schedule->command('appointments:update-status')->everySixHours();
        $schedule->command('center-notification:expire-check')->dailyAt('00:00')->timezone('Australia/Perth');
        $schedule->command('db-backend-process:backend-process')->hourly()->timezone('Australia/Perth');
        //$schedule->command('db-backend-process:backend-process')->everyMinute()->timezone('Asia/Kolkata');
        $schedule->command('media:expire')->everyMinute();
        $schedule->command('sync_massage')->everyMinute();
        $schedule->command('massage_media:expire')->everyMinute();
        $schedule->command('masseur-media:expire')->everyMinute();
        $schedule->command('pdf:clean')->everySixHours();
    }

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
