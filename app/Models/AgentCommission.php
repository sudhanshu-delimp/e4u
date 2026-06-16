<?php

namespace App\Models;

use App\Models\VariablAgentOperator;

use Illuminate\Database\Eloquent\Model;

class AgentCommission extends Model
{
    protected $fillable = [
        'agent_id',
        'purchase_amount',
        'commissionable_type',
        'commissionable_id',
        'commission_percentage',
        'commission_amount',
        'amount_type',
        'total_commission_amount',
        'commission_date',
        'notes',
        'status'
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
     * Find the assigned agent detail to the mc or escort
     * 
     * @param $userId
     * @return \App\Models\User
     */
    public function getAssignedAgent($userId = 0)
    {
        $user = User::with('assignedAgent')->where('id', $userId)->where('is_agent_assign', '1')->first();

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
        $agentCommission['agent_id'] = 0;
        $agentCommission['logged_user'] = $userId;
        $agentCommission['total_commission'] = 0;
        $agentCommission['commission'] = 0;
        $agentCommission['amount_type'] = '';
        $agentCommission['purchase_amount'] = $total;

        $commission = 0;
        if ($total > 0) {
            $assignedAgent = $this->getAssignedAgent($userId);
            if ($assignedAgent) {
                $agentCommission['agent_id'] = $assignedAgent->agent_id;
                $commission = (is_null($assignedAgent->commission_advertising_percent)) ? 0 : $assignedAgent->commission_advertising_percent;
                $amountType = $assignedAgent->commission_advertising_type;
            }
            if ($commission < 0.00001) {
                $variable =  VariablAgentOperator::where('fee_for', $feeFor)->first();
                $commission = 5;
                if ($variable) {
                    $commission = (is_null($variable->amount)) ? 0 : $variable->amount;
                    $amountType = $variable->amount_type;
                }
            }

            if ($commission > 0) {
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
        }
        return $agentCommission;
    }

    /**
     * Save the calculated commission 
     * 
     * @param \App\Models\User $userId
     * @param decimal $total
     * @param string $feeFor
     * @return boolean
     */
    public function saveCommissionData($userId, $total, $feeFor = 'advertising') 
    {
        $calculateData = $this->calculateCommission($userId, $total);
        if($calculateData['commission'] > 0 && !empty($calculateData['amount_type']) && $calculateData['agent_id'] > 0) {
            return true;
        }
        return false;
    }
}
