<?php

namespace App\Console\Commands;

use App\Models\EscortPinup;
use App\Models\Purchase;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ManagePinupWithPurchase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync_pinup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

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

        $purchases = Purchase::whereIn('status', ['listed', 'pending'])->get();
        if ($purchases->count() > 0) {
            $this->info('Records are found:- ' . $purchases->count());
            foreach ($purchases as $key => $purchase) {
                $pinup = EscortPinup::where('escort_id', $purchase->escort_id)
                    ->latest('id')
                    ->first();
                if ($pinup !== null) {
                    $this->info("=============== $key ===============");
                    $pinup->purchase_id = $purchase->id;
                    $pinup->save();
                    $this->info("Update Pinup ID {$pinup->id} (related to  Purchase ID {$purchase->id})");
                }
            }
            $this->info('All pending listed purchases processed.');
        } else {
            $this->info('No Record found.');
        }
    }
}
