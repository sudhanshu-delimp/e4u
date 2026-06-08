<?php

namespace App\Models;

use App\Models\VariablAgentOperator;

use Illuminate\Database\Eloquent\Model;

class AgentCommission extends Model
{
    protected $fillable = [
        'agent_id',
        'purchase_amount',
        'commission_percentage',
        'commission_amount',
        'status',
        'commission_date',
        'notes',
    ];

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function commissionable()
    {
        return $this->morphTo();
    }

    /**
     * Calculate the agent commission
     * 
     * @param decimal $total
     * @return array
     */
    public function calculateCommission($total = 0, $feeFor = 'advertising')
    {
        $totalCommission = 0;
        $amoutType = 'percent';
        $agentCommission['total'] = 0;
        $agentCommission['commission'] = 0;
        $agentCommission['amoutType'] = '';

        $commission = 0;
        if ($total > 0) {
            $variable =  VariablAgentOperator::where('fee_for', $feeFor)->first();
            $commission = 5;
            if ($variable) {
                $commission = $variable->amount;
                $amoutType = $variable->amount_type;
            }

            if ($amoutType == 'percent') {
                $totalCommission = ($total * $commission) / 100;
            } else {
                $totalCommission = $commission;
            }

            $totalCommission = number_format($totalCommission, 2, '.', '');

            $agentCommission['total'] = $totalCommission;
            $agentCommission['commission'] = $commission;
            $agentCommission['amoutType'] = $amoutType;
        }
        return $agentCommission;
    }
}
