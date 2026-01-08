<?php

namespace App\Console\Commands;

use App\Models\Purchase;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Repositories\Playmate\PlaymateInterface;

class SyncEscortProfile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync_escort';

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

    public function __construct(PlaymateInterface $playmateHistory)
    {
        parent::__construct();
        $this->playmateHistory = $playmateHistory;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = Carbon::now('UTC');
        /**
         * Disable Listed Profiles
         */
        $listedPurchases = Purchase::where('status', 'listed')
            ->where('utc_end_time', '<=', $now)
            ->get();
        if($listedPurchases->count() > 0){
            $this->info('Records are found.');
            foreach ($listedPurchases as $key=>$purchase) {
                $purchase->update(['status' => 'expire']);
                $escort = $purchase->escort;
                if ($escort) {
                    foreach ($escort->playmates as $playmate) {
                        $this->playmateHistory->trashPlaymateHistory($escort->id,$playmate->id);
                    }
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
                        'purchase_id' => null
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

        /**
         * Enable Listed Profiles
         */
        $pendingPurchases = Purchase::where('utc_start_time', '<=', $now)
        ->where('status','pending')
        ->get();
        if($pendingPurchases->count() > 0){
            $this->info('Records are found.');
            foreach ($pendingPurchases as $key=>$purchase) {
                $escort = $purchase->escort;
               // print_this($escort->toArray());
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
