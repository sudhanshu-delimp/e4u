<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdatePricingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pricing')->truncate();
        DB::table('pricing')->insert([
            [
                'membership_id' => 1, // Platinum
                'frequency' => 'Fixed',
                'days' => 1,
                'price' => 10.00,
                'percentage' => 6.50,
                'discount_amount' => 9.35,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'membership_id' => 2, // Gold
                'frequency' => 'Fixed',
                'days' => 1,
                'price' => 6.00,
                'percentage' => 5.00,
                'discount_amount' => 5.70,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'membership_id' => 3, // Silver
                'frequency' => 'Fixed',
                'days' => 1,
                'price' => 4.00,
                'percentage' => 5.00,
                'discount_amount' => 3.80,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'membership_id' => 4, // Free
                'frequency' => '21 days',
                'days' => 1,
                'price' => 0.00,
                'percentage' => null,
                'discount_amount' => 0.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'membership_id' => 5, // Massage Centre
                'frequency' => 'Fixed',
                'days' => 1,
                'price' => 30.00,
                'percentage' => 5.00,
                'discount_amount' => 28.50,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'membership_id' => 6, // Pin-Up
                'frequency' => 'Fixed',
                'days' => 7, // per week
                'price' => 475.00,
                'percentage' => 0.00,
                'discount_amount' => 475.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'membership_id' => 7, // Bump-Up
                'frequency' => 'Fixed',
                'days' => 1,
                'price' => 6.00,
                'percentage' => 0.00,
                'discount_amount' => 6.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
    
}
