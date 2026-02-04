<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MassageDurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('massage_durations')->truncate();

          DB::table('massage_durations')->insert([
            [
                'name' => 'Blow & Go',
                'arrange_by' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '15 Minutes',
                'arrange_by' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '30 Minutes',
                'arrange_by' => '3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '45 Minutes',
                'arrange_by' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '1 Hour',
                'arrange_by' => '5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '1.5 Hours',
                'arrange_by' => '6',
                'created_at' => now(),
                'updated_at' => now(),
            ],  
            [
                'name' => '2 Hours',
                'arrange_by' => '7',
                'created_at' => now(),
                'updated_at' => now(),
            ],  
             [
                'name' => 'Overnight',
                'arrange_by' => '8',
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'name' => 'Socialising',
                'arrange_by' => '9',
                'created_at' => now(),
                'updated_at' => now(),
            ],  

        ]);

    }
}
