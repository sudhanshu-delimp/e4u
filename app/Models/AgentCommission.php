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

    public function getAssignedAgent($userId = 0)
    {
        $user = User::with('assignedAgent')->where('id', $userId)->where('is_agent_assign', 1)->first();

        if ($user && $user->assignedAgent) {
            return $user->assignedAgent;
        }

        return false;
    }

    /**
     * Calculate the agent commission
     * 
     * @param \App\Models\User $userId
     * @param decimal $total
     * @param string $feeFor
    
     * @return array
     */
    public function calculateCommission($userId = 0, $total = 0, $feeFor = 'advertising')
    {
        $totalCommission = 0;
        $amountType = 'percent';
        $agentCommission['total_commission'] = 0;
        $agentCommission['commission'] = 0;
        $agentCommission['amount_type'] = '';
        $agentCommission['purchase_amount'] = $total;

        $commission = 0;
        if ($total > 0) {
            $variable =  VariablAgentOperator::where('fee_for', $feeFor)->first();
            $commission = 5;
            if ($variable) {
                $commission = $variable->amount;
                $amountType = $variable->amount_type;
            }

            if ($amountType == 'percent') {
                $totalCommission = ($total * $commission) / 100;
            } else {
                $totalCommission = $commission;
            }

            $totalCommission = number_format($totalCommission, 2, '.', '');

            $agentCommission['total_commission'] = $totalCommission;
            $agentCommission['commission'] = $commission;
            $agentCommission['amount_type'] = $amountType;
        }
        return $agentCommission;
    }
}
