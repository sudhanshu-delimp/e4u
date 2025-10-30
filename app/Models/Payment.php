<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Payment extends Model
{
    protected $guarded = ['id'];
    protected $table = "payments";
    protected $casts = [
    'referenceId' => 'array',
    'plan_type' => 'array',
    
    ];

    protected $dates = ['start_date', 'end_date'];

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = empty($value)?null:Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = empty($value)?null:Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }

}
