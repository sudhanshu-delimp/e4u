<?php

namespace App\Console\Commands;

use App\Models\Escort;
use App\Models\Purchase;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DisableEscortProfile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'disable_escort';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Based on the escort profile end date, disable the profile (set enable to 0)';

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
        $listedPurchases = Purchase::where('status', 'listed')
            ->where('utc_end_time', '<=', $now)
            ->get();
        if($listedPurchases->count() > 0){
            $this->info('Records are found.');
            foreach ($listedPurchases as $key=>$purchase) {
                $purchase->update(['status' => 'expire']);
                $escort = $purchase->escort;
                if ($escort) {
                    /**
                     * Detach all playmates this escort added
                     */
                    $escort->playmates()->detach();
                    /**
                     * Detach this escort from other users who added them as a playmate
                     */
                    $escort->addedBy()->detach();
                    $escort->update([
                        'enabled' => 0,
                        'membership' => null,
                        'start_date' => null,
                        'end_date' => null,
                        'utc_start_time' => null,
                        'utc_end_time' => null,
                    ]);
                    $this->info("=============== $key ===============");
                    $this->info("Disabled Escort ID {$escort->id} (related to expired Purchase ID {$purchase->id})");
                }
            }
    
            $this->info('All expired listed purchases processed.');
        }
        else{
            $this->info('No Record found.');
        }
    }
}
