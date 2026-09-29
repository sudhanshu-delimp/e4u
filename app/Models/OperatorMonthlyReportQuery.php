<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Model;

class OperatorMonthlyReportQuery extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_date',
        'fee_report_id',
        'notes',
        'status',
        'submitted_by',
        'user_type',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['updated_at'];

       public function submittedBy()
    {
        return $this->belongsTo('App\Models\User', 'submitted_by', 'id')->select('id', 'member_id', 'name', 'business_name','email');
    }


}
