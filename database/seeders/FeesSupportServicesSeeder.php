<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeesSupportServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run(): void
    {
        $services = [
            ['fee' => 'Create Profile', 'amount' => 50.00],
            ['fee' => 'Edit Profile', 'amount' => 20.00],
            ['fee' => 'Create Tour', 'amount' => 50.00],
            ['fee' => 'Edit Tour', 'amount' => 20.00],
            ['fee' => 'Upload Media (for verification)', 'amount' => 20.00],
            ['fee' => 'Complete Media Verification (excluding Platinum)', 'amount' => 10.00],
            ['fee' => 'Complete Profile Information', 'amount' => 30.00],
            ['fee' => 'Organise Profiles and Media in Archives', 'amount' => 50.00],
        ];

        foreach ($services as $service) {
            DB::table('fees_support_services')->insert([
                'fee' => $service['fee'],
                'frequency' => 'Per Service',
                'amount' => $service['amount'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
