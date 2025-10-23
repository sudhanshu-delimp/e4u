<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Escort;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\ListingExpiryReminder;

class SendProfileListingExpiryReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'escort:send-listing-expiry-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email reminders 2 days before escort Profile listing expires';

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
       $targetDate = Carbon::now()->addDays(2)->startOfDay();
       $endOfTargetDate = (clone $targetDate)->endOfDay();
       $escorts = Escort::where('enabled', 1)
            ->whereBetween('utc_end_time', [$targetDate, $endOfTargetDate])
            ->get();
        if($escorts->count()>0){
            foreach ($escorts as $escort) {
                if ($escort->user && $escort->user->email) {
                    Mail::to($escort->user->email)->queue(new ListingExpiryReminder($escort));
                    $this->info("Reminder sent to {$escort->user->email} for Escort ID {$escort->id}");
                    sleep(15);
                }
            }
            $this->info('All reminders processed.');
        }    
    }
}
