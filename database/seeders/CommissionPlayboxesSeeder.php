<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommissionPlayboxesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('commission_playboxes')->insert([
            [
                'amount' => 10.00,
                'discription' => 'Earnings portion - Escort',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ]);
    }
}
