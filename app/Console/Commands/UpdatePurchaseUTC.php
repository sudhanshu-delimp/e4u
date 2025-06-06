<?php

namespace App\Console\Commands;

use App\Models\Escort;
use App\Models\Purchase;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdatePurchaseUTC extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update_purchase_utc';

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
        $now = Carbon::now('UTC');
        $purchases = Purchase::all();
        if($purchases->count() > 0){
            $this->info('Records are found.');
            foreach ($purchases as $key=>$purchase) {
                $start_date = $purchase['start_date'].' 00:00:00';
                $end_date = $purchase['end_date'].' 23:59:59';
                $escort = $purchase->escort;
                if($escort){
                    $profileTimezone = config("escorts.profile.states.$escort->state_id.cities.$escort->city_id.timeZone");
                    $localStartDateTime = Carbon::createFromFormat('Y-m-d H:i:s', "$start_date", $profileTimezone);

                    $utcSartTime = $localStartDateTime->copy()->setTimezone('UTC');
        
                    $localEndDateTime = Carbon::createFromFormat('Y-m-d H:i:s', "$end_date", $profileTimezone);
                    $utcEndTime = $localEndDateTime->copy()->setTimezone('UTC');
                    $purchase->update([
                        'utc_start_time' => $utcSartTime,
                        'utc_end_time' => $utcEndTime,
                    ]);
                }
                
                $this->info("=============== $key ===============");
                $this->info("Update Escort ID {$purchase->escort_id} (related to pending Purchase ID {$purchase->id})");
            }
            $this->info('All pending listed purchases processed.');
        }
        else{
            $this->info('No Record found.');
        }
    }
}
