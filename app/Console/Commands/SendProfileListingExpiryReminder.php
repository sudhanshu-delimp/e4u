<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Escort;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Repositories\Escort\EscortInterface;
use App\Mail\ListingExpiryReminder;

class SendProfileListingExpiryReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'escort:send-listing-expiry-reminders';
    protected $escort;

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
    public function __construct(EscortInterface $escort)
    {
        parent::__construct();
        $this->escort = $escort;
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
       $escorts = $this->escort->getExpiringListings(1,1);
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
        else{
            $this->info('No reminders found.');
        }
    }
}
