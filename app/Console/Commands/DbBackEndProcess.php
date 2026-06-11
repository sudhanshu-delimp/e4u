<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class DbBackEndProcess extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db-backend-process:backend-process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        try 
        {
            //    $yesterday = Carbon::yesterday();
            //     $media = DB::table('massuers_media as mm')
            //         ->select('mm.id', 'mm.path', 'mm.masseur_token_id')
            //         ->whereDate('mm.created_at', $yesterday)
            //         ->whereNotExists(function ($query) {
            //             $query->select(DB::raw(1))
            //                 ->from('masseur_galleries as mg')
            //                 ->whereColumn('mg.masseur_token_id', 'mm.masseur_token_id');
            //         })->get();

            //     foreach ($media as $item) 
            //     {

            //         $filePath = public_path($item->path);
            //         if (is_file($filePath)) {

            //             $deleted = unlink($filePath);
            //             Log::info('Delete result', [
            //                 'path' => $filePath,
            //                 'deleted' => $deleted,
            //                 'error' => error_get_last(),
            //             ]);
            //         }
            //     }

            //     DB::table('massuers_media')->whereIn('id', $media->pluck('id'))->delete();
        } 
        catch (Exception $e) {
            Log::error('Error while processing masseur media', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'trace'   => $e->getTraceAsString(),
            ]);
        } 
            
    }
}
