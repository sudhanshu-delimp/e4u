<?php

namespace App\Models;

use App\Models\VariablAgentOperator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Exception;

class AgentCommission extends Model
{
    protected $fillable = [
        'agent_id',
        'user_id',
        'user_type',
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

     public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function commissionable()
    {
        return $this->morphTo();
    }

    public function paymentHistory()
    {
        return $this->belongsTo(PaymentHistory::class, 'commissionable_id');
    }

    public function items()
    {
        return $this->hasOne(PaymentItem::class, 'payment_history_id', 'commissionable_id')->select(['id', 'payment_history_id', 'item_type', 'item_id', 'amount']);
    }

    /**
     * Find the assigned agent detail to the mc or escort
     * 
     * @param $userId
     * @return \App\Models\User
     */
    public function getAssignedAgent($userId = 0)
    {
        //Log::info("User ID:" . $userId);
        /* $agentDetail =  (new AgentDetail);
        $user2 = User::where('id', $userId)->where('is_agent_assign', '1')->first();
        if($user2) {
            $assigned_agent_id = $user2->assigned_agent_id;
            $agent =$agentDetail->where('agent_id', $assigned_agent_id)->first();
            if(!$agent) {
                $variable =  VariablAgentOperator::where('fee_for', 'advertising')->first();
                $mcSignup =  VariablAgentOperator::where('fee_for', 'mc_signup')->first();
                 $commission = 5;
                 $amountType = 'percent';
                 if ($variable) {
                        $commission = (is_null($variable->amount)) ? 0 : $variable->amount;
                        $amountType = $variable->amount_type;
                }
                $mcSignupcommission = 5;
                $mcSignupamountType = 'percent';
                if ($mcSignup) {
                        $mcSignupcommission = (is_null($mcSignup->amount)) ? 0 : $mcSignup->amount;
                        $mcSignupamountType = $mcSignup->amount_type;
                }
                $agentDetail->agent_id = $assigned_agent_id;
                $agentDetail->commission_advertising_percent = $commission;
                $agentDetail->commission_advertising_type = $amountType;
                $agentDetail->commission_registration_amount = $mcSignupcommission;
                $agentDetail->commission_registration_type = $mcSignupamountType;
                $agentDetail->save();
                //Log::info("Agent detail created:");
            }
        } */

        $user = User::with('assignedAgent')->where('id', $userId)->where('is_agent_assign', '1')->first();

        if ($user && $user->assignedAgent) {
            return $user;
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
        $agentCommission['user_type'] = null;
        //Log::info("Total amount :" . $total);

        $commission = 0;
        if ($total > 0) {
            $user = $this->getAssignedAgent($userId);
            if ($user && $user->assignedAgent) {
                $assignedAgent = $user->assignedAgent;
                // Log::info("Agent_details:" . json_encode($assignedAgent));
                $agentCommission['user_type'] = $user->type;
                $agentCommission['agent_id'] = $assignedAgent->agent_id;
                //$commission = (is_null($assignedAgent->commission_advertising_percent)) ? 0 : $assignedAgent->commission_advertising_percent;
                $amountType = $assignedAgent->commission_advertising_type;

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
                    if ($totalCommission > $total) {
                        $totalCommission = $total;
                    }

                    $totalCommission = number_format($totalCommission, 2, '.', '');

                    $agentCommission['total_commission'] = $totalCommission;
                    $agentCommission['commission'] = $commission;
                    $agentCommission['amount_type'] = $amountType;
                    //Log::info("Commission Calculated");
                }
            }
        }
        return $agentCommission;
    }

    /**
     * Save the calculated commission 
     * 
     * @param Object $massageEscortPurchase
     * @param \App\Models\User $userId
     * @param decimal $total
     * @param string $feeFor
     * @return boolean
     */
    public function saveCommissionData($massageEscortPurchase, $userId, $total, $feeFor = 'advertising')
    {
        try {
            // Log::info("saveCommissionData function triggered");
            $agentCommission = $this->calculateCommission($userId, $total);
            //Log::info("agentCommission:" . json_encode($agentCommission));
            if ($agentCommission['commission'] > 0 && !empty($agentCommission['amount_type']) && $agentCommission['agent_id'] > 0) {
                if ($massageEscortPurchase) {
                    $massageEscortPurchase->commissions()->create([
                        'agent_id' => $agentCommission['agent_id'],
                        'user_id' => $userId,
                        'user_type' => (int)$agentCommission['user_type'],
                        'purchase_amount' => $total,
                        'commission_amount' => $agentCommission['commission'],
                        'amount_type' => $agentCommission['amount_type'],
                        'total_commission_amount' => $agentCommission['total_commission'],
                        'commission_date' => now(),
                    ]);
                    //Log::info("Agent commisson proceeded");
                    return true;
                }
            }
        } catch (Exception $e) {
            Log::error("Agent Commission Exception:" . $e->getMessage());
        }
        return false;
    }

    /**
     * Get total earning of agent by Escort or Massage
     * 
     * @param \App\Models\User $userId
     * @param integer $isFormatted
     * @return integer
     */
    public function getTotalEarning($userId = 0, $isFormatted = 0)
    {
        $price = self::where('user_id', $userId)
            ->sum('total_commission_amount');
        if ($isFormatted == 1) {
            $price = number_format($price, 2);
        }
        return $price;
    }
}
