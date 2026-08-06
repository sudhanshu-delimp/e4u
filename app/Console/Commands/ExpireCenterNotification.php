<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\AgentNotification;
use App\Models\CenterNotification;
use App\Models\EscortNotification;
use App\Models\GlobalNotification;
use App\Models\LegboxNotification;
use App\Models\ViewerNotification;
use App\Models\ShareholderNotification;

class ExpireCenterNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:expire-check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Center Notification';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::today()->toDateString();

        //Create by Admin 
        CenterNotification::where('end_date', '<', $today)
                    ->whereNotNull('end_date')
                    ->where('status', 'Published')
                    ->update(['status' => 'Completed']);
        
       
        AgentNotification::where('status', 'Published')
            ->whereNotNull('end_date')
            ->where('end_date', '<', $today)
            ->update(['status' => 'Completed']);


        ViewerNotification::where('end_date', '<', $today)
            ->whereNotNull('end_date')
            ->where('status', 'Published')
            ->update(['status' => 'Completed']);


        EscortNotification::where('end_date', '<', $today)
            ->whereNotNull('end_date')
            ->where('status', 'Published')
            ->update(['status' => 'Completed']);

        GlobalNotification::where('end_date', '<', $today)
            ->whereNotNull('end_date')
            ->where('status', 'Published')
            ->update(['status' => 'Completed']);

        ShareholderNotification::where('end_date', '<', $today)
            ->whereNotNull('end_date')
            ->where('status', 'Published')
            ->update(['status' => 'Completed']);

        //Legbox Notification for the Viewer, create by Massage Center

        LegboxNotification::where('end_date', '<', $today)
            ->whereNotNull('end_date')
            ->where('status', 'Published')
            ->update(['status' => 'Completed']);

    }
}
