<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\VariablAgentOperator;

class CreateMissingAgentDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {

        $variable =  VariablAgentOperator::where('fee_for', 'advertising')->first();
        $mcSignup =  VariablAgentOperator::where('fee_for', 'mc_signup')->first();
        $commission = 0;
        $amountType = 'percent';
        if ($variable) {
            $commission = (is_null($variable->amount)) ? 0 : $variable->amount;
            $amountType = $variable->amount_type;
        }
        $mcSignupcommission = 0;
        $mcSignupamountType = 'percent';
        if ($mcSignup) {
            $mcSignupcommission = (is_null($mcSignup->amount)) ? 0 : $mcSignup->amount;
            $mcSignupamountType = $mcSignup->amount_type;
        }

        User::where('type', '5')
            ->doesntHave('agent_detail')
            ->chunk(100, function ($users) use($commission, $amountType, $mcSignupcommission, $mcSignupamountType) {
                foreach ($users as $user) {
                    $user->agent_detail()->create([
                        'agent_id' => $user->id,
                        'commission_advertising_percent' => $commission,
                        'commission_advertising_type' => $amountType,
                        'commission_registration_amount' => $mcSignupcommission,
                        'commission_registration_type' => $mcSignupamountType,
                    ]);
                }
            });
    }
}
