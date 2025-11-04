<?php

namespace App\Console\Commands;

use App\Models\CenterNotification;
use Illuminate\Console\Command;

class ExpireCenterNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'center-notification:expire-check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Center Notification';

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
        CenterNotification::where('finish_date', '<', now())->where('status', 'Published')->update(['status' => 'Completed']);
    }
}
