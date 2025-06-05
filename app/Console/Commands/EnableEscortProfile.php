<?php

namespace App\Console\Commands;

use App\Models\Escort;
use App\Models\Purchase;
use Carbon\Carbon;
use Illuminate\Console\Command;

class EnableEscortProfile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'enable_escort';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Based on the listing, add start-end date to escort profile and enable the profile';

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
        $startDate = Carbon::now()->format('Y-m-d');
        $listings = Purchase::where('start_date', $startDate)->get()->toArray();

        foreach ($listings as $listing) {
            $start_date = $listing['start_date'].' 00:00:00';
            $end_date = $listing['end_date'].' 23:59:59'; 
            $escort = $listing->escort;
            
            $profileTimezone = config("escorts.profile.states.$escort->state_id.cities.$escort->city_id.timeZone");
            
            $localStartDateTime = Carbon::createFromFormat('Y-m-d H:i:s', "$start_date", $profileTimezone);
            $utcSartTime = $localStartDateTime->copy()->setTimezone('UTC');
            $localEndDateTime = Carbon::createFromFormat('Y-m-d H:i:s', "$end_date", $profileTimezone);
            $utcEndTime = $localEndDateTime->copy()->setTimezone('UTC');
            Escort::where('id', $listing['escort_id'])->update(
                array(
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'utc_start_time' => $utcSartTime,
                    'utc_end_time' => $utcEndTime,
                    'membership' => $listing['membership'],
                    'enabled' => 1,
                )
            );
            $this->info('Success');
        }
    }
}
