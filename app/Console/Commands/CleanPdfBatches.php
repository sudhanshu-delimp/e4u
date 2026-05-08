<?php

namespace App\Console\Commands;

use App\Models\PdfBatch;
use Illuminate\Console\Command;

class CleanPdfBatches extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pdf:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete old PDF/ZIP files';

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
         $batches = PdfBatch::where('created_at','<', now()->utc()->subHours(3))->get();
         foreach($batches as $batch){
            if ($batch->file_path && file_exists($batch->file_path)) {
                unlink($batch->file_path);
            }
            $batch->delete();
         }

         $this->info('Cleaned: ' . $batches->count() . ' batches.');
    }
}
