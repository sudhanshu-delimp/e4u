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
        DB::table('fees_support_services')->truncate();
        $services = [
            ['category' => 'Profile Management', 'fee' => 'Create a Profile', 'frequency' => 'Per Service', 'amount' => 75.00],
            ['category' => 'Profile Management', 'fee' => 'Edit a Profile', 'frequency' => 'Per Service','amount' => 50.00],
            ['category' => 'Profile Management', 'fee' => 'Create a Tour', 'frequency' => 'Per Service', 'amount' => 150.00],
            ['category' => 'Profile Management', 'fee' => 'Edit a Tour', 'frequency' => 'Per Service', 'amount' => 50.00],
            ['category' => 'Profile Management', 'fee' => 'Upload Media and complete verification', 'frequency' => 'Per Service', 'amount' => 50.00],
            ['category' => 'Profile Management', 'fee' => 'Organise Profiles by Location', 'frequency' => 'Per Service', 'amount' => 50.00],
            ['category' => 'My Account', 'fee' => 'Complete My Information', 'frequency' => 'Per Service', 'amount' => 50.00],
            ['category' => 'Profile Management', 'fee' => 'List a Profile', 'frequency' => 'Per Service', 'amount' => 50.00],
            ['category' => 'Profile Management', 'fee' => 'List a Tour', 'frequency' => 'Per Service', 'amount' => 50.00],
            ['category' => 'My Playbox', 'fee' => 'Establishing an Escort,s Playbox', 'frequency' => 'Per Service', 'amount' => 150.00],
            ['category' => 'My Playbox', 'fee' => 'Updating Escort,s Playbox', 'frequency' => 'Per Service', 'amount' => 75.00],
        ];

        foreach ($services as $service) {
            DB::table('fees_support_services')->insert([
                'category' => $service['category'],
                'fee' => $service['fee'],
                'frequency' => $service['frequency'],
                'amount' => $service['amount'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
