<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Model;

class OperatorMonthlyReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_date',
        'billing_period_from',
        'billing_period_to',
        'operator_id',
        'country_id',
        'spend',
        'fees',
        'agent_ids',
        'agent_fees',
        'status',
        'report_approved',
        'approved_by',
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

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id');
    }

    public function operator()
    {
        return $this->belongsTo('App\Models\User', 'operator_id', 'id');
    }

    public function operatorMonthlyReportQuery()
    {
        return $this->hasMany('App\Models\OperatorMonthlyReportQuery', 'fee_report_id', 'id');
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
