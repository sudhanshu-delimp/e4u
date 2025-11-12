<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EscortAccountSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'notification_feature',
        'auto_recharge_option',
        'agent_communications',
        'alert_notifications',
        'idle_time',
        'auth',
        'num',
        'subscription',
    ];

    protected $casts = [
        'notification_feature' => 'array',
        'agent_communications' => 'array',
        'alert_notifications' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
