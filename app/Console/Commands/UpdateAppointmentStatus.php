<?php

namespace App\Console\Commands;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateAppointmentStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appointments:update-status';  
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark appointments as Over Due if not completed or rescheduled after 2 days (UTC)';

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
        //compare with UTC time
        $threshold = Carbon::now('UTC')->subDays(2);
        //Filter using UTC date stored in DB
        $appointments = Appointment::where('status', 'in_progress')
                        ->where('date', '<', $threshold)->get();

        foreach($appointments as  $appointment){
            $appointment->status  = 'over_due';
            $appointment->save();
        }
        $this->info('Appointment statuses updated to over_due (UTC check)!');
    }
}
