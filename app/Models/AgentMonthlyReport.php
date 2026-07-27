<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Model;

class AgentMonthlyReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_date',
        'billing_period_from',
        'billing_period_to',
        'agent_id',
        'state_id',
        'spend',
        'fees',
        'status',
        'report_approved',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'report_date' => 'date',
        'billing_period_from' => 'date',
        'billing_period_to' => 'date',
        'report_approved' => 'date',
    ];

     /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['updated_at', 'created_by', 'updated_by'];

    public function state()
    {
        return $this->belongsTo('App\Models\State', 'state_id');
    }

    public function agent()
    {
        return $this->belongsTo('App\Models\User', 'agent_id', 'id');
    }

     public function AgentMonthlyReportQuery()
    {
        return $this->hasMany('App\Models\AgentMonthlyReportQuery', 'fee_report_id', 'id');
    }


    /**
     * Indicates if the model should have created_by and updated_by fields.
     *
     * @var bool
     */
    public $createdUpdatedBy = true;

    /**
     * Get the created by that owns the details.
     */
    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    /**
     * Get the updated by that owns the details.
     */
    public function updatedBy()
    {
        return $this->belongsTo('App\Models\User', 'updated_by');
    }
}
