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
     * Calculate the agent commision
     * 
     * @param decimal $total
     * @return array
     */
    public function calculateCommision($total = 0, $feeFor = 'advertising')
    {
        $totalCommision = 0;
        $amoutType = 'percent';
        $agentCommision['total'] = 0;
        $agentCommision['commision'] = 0;
        $agentCommision['amoutType'] = '';

        $commision = 0;
        if ($total > 0) {
            $variable =  VariablAgentOperator::where('fee_for', $feeFor)->first();
            $commision = 5;
            if ($variable) {
                $commision = $variable->amount;
                $amoutType = $variable->amount_type;
            }

            if ($amoutType == 'percent') {
                $totalCommision = ($total * $commision) / 100;
            } else {
                $totalCommision = $commision;
            }

            $totalCommision = number_format($totalCommision, 2, '.', '');

            $agentCommision['total'] = $totalCommision;
            $agentCommision['commision'] = $commision;
            $agentCommision['amoutType'] = $amoutType;
        }
        return $agentCommision;
    }
}
