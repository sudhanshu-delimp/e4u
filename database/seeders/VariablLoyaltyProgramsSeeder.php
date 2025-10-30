<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VariablLoyaltyProgramsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('variabl_loyalty_programs')->insert([
            [
                'type' => 'Escorts',
                'level' => 'P, G, S',
                'discription' => 'Loyalty program for escorts — Platinum, Gold, and Silver levels.',
                'amount' => 100.00,
                'reward' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Massage Centre',
                'level' => 'MC',
                'discription' => 'Loyalty program for massage centres.',
                'amount' => 150.00,
                'reward' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
