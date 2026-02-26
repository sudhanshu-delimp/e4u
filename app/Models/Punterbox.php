<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Punterbox extends Model
{
    use HasFactory;

    protected $table = 'punterbox';

    protected $fillable = [
        'user_id',
        'incident_date',
        'incident_state',
        'incident_location',
        'escort_name',
        'escort_mobile',
        'escort_email',
        'incident_nature',
        'platform',
        'profile_link',
        'what_happened',
        'rating',
        'status',
        'admin_action',
        'admin_id',
    ];

    protected $casts = [
        'incident_date' => 'date',
        'status'        => 'integer',
        'user_id'       => 'integer',
        'admin_id'      => 'integer',
    ];

     protected $statusMap = [
        '0' => 'Pending',
        '1' => 'Published',
        '2' => 'On Hold',
        '3' => 'Rejected',
    ];

     public function getStatusTextAttribute()
    {
        return $this->statusMap[$this->status] ?? 'NA';
    }

    // User who created report
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Admin who took action
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'incident_state');
    }
}
