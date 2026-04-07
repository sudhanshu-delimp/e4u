<?php

namespace App\Console\Commands;

use App\Models\MassagePurchase;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SyncMassageProfile extends Command
{

    protected $signature = 'sync_massage';
    protected $description = 'Command description';

   
    public function __construct()
    {
        parent::__construct();
    }

   
    public function handle()
    {
        $now = Carbon::now('UTC');
        $listedPurchases = MassagePurchase::where('status', 'listed')->where('utc_end_time', '<=', $now)->get();

        if($listedPurchases->count() > 0)
        {
            $this->info('Records are found.');
            foreach ($listedPurchases as $key=>$purchase) {
                $purchase->update(['status' => 'expire']);

                $massageprofile = $purchase->massageprofile;
                if($massageprofile)
                {
                    $massageprofile->purchase_id = null;
                    $massageprofile->save();
                }
            }
            $this->info('All expired listed purchases processed.');
        }
        else{
            $this->info('No Record found.');
        }

      
        $pendingPurchases = MassagePurchase::where('utc_start_time', '<=', $now)->where('status','pending')->get();
        if($pendingPurchases->count() > 0)
        {
            $this->info('Records are found.');
            foreach ($pendingPurchases as $key=>$purchase) 
            {
                $purchase->update(['status'=>'listed']);

                $massageprofile = $purchase->massageprofile;
                if($massageprofile)
                {
                    Log::info('massageprofile');
                    Log::info($massageprofile);

                    $massageprofile->purchase_id = $purchase->id;
                    $massageprofile->save();
                }

                $this->info("=============== $key ===============");
                $this->info("Enabled Escort ID {$purchase->massage_centre_id} (related to pending Purchase ID {$purchase->id})");
               
            }
            $this->info('All pending listed purchases processed.');
        }
        else
        {
            $this->info('No Record found.');
        }
    }

    
}
