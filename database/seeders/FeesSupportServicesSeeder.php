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
            ['fee' => 'Create Profile', 'frequency' => 'Per Service', 'amount' => 50.00],
            ['fee' => 'Edit Profile', 'frequency' => 'Per Service','amount' => 20.00],
            ['fee' => 'Create Tour', 'frequency' => 'Per Service', 'amount' => 50.00],
            ['fee' => 'Edit Tour', 'frequency' => 'Per Service', 'amount' => 20.00],
            ['fee' => 'Upload Media (for verification)', 'frequency' => 'Per Service', 'amount' => 20.00],
            ['fee' => 'Complete Media Verification (excluding Platinum)', 'frequency' => 'Per Service', 'amount' => 10.00],
            ['fee' => 'Complete Profile Information', 'frequency' => 'Per Service', 'amount' => 30.00],
            ['fee' => 'Organise Profiles and Media in Archives', 'frequency' => 'Per Service', 'amount' => 50.00],
            ['fee' => 'Organise a Concierge service', 'frequency' => 'Complete a Concierge Services request, assist with the delivery if applicable', 'amount' => 75.00],
            ['fee' => 'Establishing an Escort,s Playbox', 'frequency' => 'Upload Content(3) to theEscort,s Playbox, ensuring compliance, create the Playbox profile, including setting the pricing schedule.', 'amount' => 100.00],
            ['fee' => 'Updating Escort,s Playbox', 'frequency' => 'Remove Content and / or upload new Content and post to the Escort,s Playbox. Undertake any maintenance issues.', 'amount' => 75.00],
        ];

        foreach ($services as $service) {
            DB::table('fees_support_services')->insert([
                'fee' => $service['fee'],
                'frequency' => $service['frequency'],
                'amount' => $service['amount'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
