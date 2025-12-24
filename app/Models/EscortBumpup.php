<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class EscortBumpup extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'escort_id',
        'start_date',
        'end_date',
        'utc_start_time',
        'utc_end_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function escort()
    {
        return $this->belongsTo(Escort::class);
    }
    
    public function scopeActive($query)
    {
        return $query->where('utc_start_time', '<=', Carbon::now('UTC'))
        ->where('utc_end_time', '>=', Carbon::now('UTC'));
    }
}
