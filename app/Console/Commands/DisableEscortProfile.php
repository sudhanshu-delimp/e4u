<?php

namespace App\Console\Commands;

use App\Models\Escort;
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

        $today = Carbon::now()->format('Y-m-d');


        //dd(auth()->user()->created_at);
        Escort::whereDate('end_date','<',$today)->update(['enabled' => 0]);

        //return $mytime;,'membership'=>null
    }
}
