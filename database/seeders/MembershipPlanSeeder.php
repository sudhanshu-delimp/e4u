<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MembershipPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   public function run(): void
        {
            DB::table('membership_plan')->truncate();
            DB::table('membership_plan')->insert([
                ['name' => 'Platinum', 'is_for_calculater' => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['name' => 'Gold', 'is_for_calculater' => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['name' => 'Silver', 'is_for_calculater' => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['name' => 'Free<sup>(3)</sup>', 'is_for_calculater' => '0', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['name' => 'Pin-Up<sup>(4)</sup>', 'is_for_calculater' => '0', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['name' => 'Bump Up', 'is_for_calculater' => '0', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ]);
        }
}
