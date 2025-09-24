<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewerNotificationSetting extends Model
{
    use HasFactory;

    protected $table = "viewer_notification_settings";
    protected $fillable = ['user_id','user_type', 'advertiser_email', 'advertiser_text','is_adviser_notification_on','escort_email','escort_text','is_escort_notification_on','twofa','idle_preference_time'];
}
