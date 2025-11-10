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
        $now = Carbon::now('UTC');
        $pendingPurchases = Purchase::where('utc_start_time', '<=', $now)
        ->where('status','pending')
        ->get();
        if($pendingPurchases->count() > 0){
            $this->info('Records are found.');
            foreach ($pendingPurchases as $key=>$purchase) {
                $escort = $purchase->escort;
                if($escort){
                    $escort->update([
                        'start_date' => $purchase['start_date'],
                        'end_date' => $purchase['end_date'],
                        'utc_start_time' => $purchase['utc_start_time'],
                        'utc_end_time' => $purchase['utc_end_time'],
                        'membership' => $purchase['membership'],
                        'enabled' => 1,
                        'purchase_id' => $purchase['id']
                    ]);
                }
                $purchase->update(['status'=>'listed']);
                $this->info("=============== $key ===============");
                $this->info("Enabled Escort ID {$purchase->escort_id} (related to pending Purchase ID {$purchase->id})");
            }
            $this->info('All pending listed purchases processed.');
        }
        else{
            $this->info('No Record found.');
        }
    }
}
