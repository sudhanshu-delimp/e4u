<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PricingFeeUpdateLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $feeTypes = [
            'pricing',
            'fees_concierge_services',
            'fees_support_services',
            'variabl_agent_operators',
            'variabl_loyalty_programs',
            'commission_playboxes'
        ];

        foreach ($feeTypes as $type) {
            DB::table('pricing_fee_update_logs')->insert([
                'fee_type'          => $type,
                'last_updated_date' => '2025-06-16', 
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);
        }
    
    }
}
