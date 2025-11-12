<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Num extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'incident_date',
        'incident_state',
        'incident_location',
        'offender_name',
        'offender_mobile',
        'offender_email',
        'incident_nature',
        'platform',
        'profile_link',
        'what_happened',
        'rating',
        'status',
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'incident_state');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
