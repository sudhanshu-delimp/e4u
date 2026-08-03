<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Model;

class AgentMonthlyReportQuery extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_date',
        'fee_report_id',
        'notes',
        'status',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['updated_at'];


}
