<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tour;

class FixTourDatesFromLocations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tour:fix-dates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Tour start and end dates based on related Tour Locations';

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
        $tours = Tour::with('locations')->get();
        $updated = 0;
        foreach ($tours as $tour) {
            $minStart = $tour->locations->min('start_date')->format('Y-m-d');
            $maxEnd = $tour->locations->max('end_date')->format('Y-m-d');
            $this->info("minStart {$minStart}  maxEnd {$maxEnd}");
            if ($minStart || $maxEnd) {
                $tour->update([
                    'start_date' => $minStart,
                    'end_date'   => $maxEnd,
                ]);
                $updated++;
            }
        }
        $this->info("Tour dates updated successfully for {$updated} tours.");
    }
}
