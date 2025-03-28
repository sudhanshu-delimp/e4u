<?php

namespace App\Console\Commands;

use App\Models\Playmate;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendPlaymateAccountDisableMail;

class SendPlaymateProfileDeactivationNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:playmate_disable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send playmate deactivation email notification to the user';

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
        $playmates = Playmate::with('users')->with('escorts')->whereHas('escorts', function($query) {
            $query->where('end_date', '=', date('Y-m-d', strtotime('+1 day')) . ' 00:00:00');
        })->get();
        if($playmates->count()) {
            foreach ($playmates as $playmate) {
                $data = [
                    'user_name' => $playmate->users->name,
                    'playmate_name' => $playmate->escorts->name,
                    'playmate_profile_name' => $playmate->escorts->profile_name
                ];
                Mail::to($playmate->users->email)->send(new sendPlaymateAccountDisableMail($data));
            }
        }

        $this->info('Notification for playmate profile deactivate sent!');
    }
}
