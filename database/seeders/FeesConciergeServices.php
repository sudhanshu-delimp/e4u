<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeesConciergeServices extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fees_concierge_services')->insert([
            [
                'service_type' => 'Accommodation',
                'frequency' => 'Per Service',
                'amount' => 250.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'service_type' => 'Email Account',
                'frequency' => 'Per Service',
                'amount' => 50.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'service_type' => 'Mobile SIM',
                'frequency' => 'Per Service',
                'amount' => 30.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'service_type' => 'Travel',
                'frequency' => 'Per Service',
                'amount' => 500.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'service_type' => 'Visa Migration & Education Placement',
                'frequency' => 'Per Service',
                'amount' => 1000.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
