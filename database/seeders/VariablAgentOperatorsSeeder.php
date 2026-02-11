<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VariablAgentOperatorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('variabl_agent_operators')->insert([
            [
                'rate' => '1',
                'amount' => 5.00,
                'percent' => '5.00%',
                'discription' => 'Commission - Advertising',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rate' => '2',
                'amount' => 20.00,
                'percent' => '20.00%',
                'discription' => 'Commission - Massage Centre sign up',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rate' => '3',
                'amount' => 2.00,
                'percent' => '5.00%',
                'discription' => 'Commission - Operator',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
