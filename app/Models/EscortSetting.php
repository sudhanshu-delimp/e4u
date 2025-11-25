<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EscortSetting extends Model
{
    use HasFactory;

    protected $fillable = [
    "user_id",
    "features_viewer_notifications_forward-v-alerts",
    "features_allow_viewers_to_ask_you_a_question",
    "features_allow_viewers_to_send_you_a_text_message",
    "features_i_am_available_as_a_playmate",
    "auto_recharge_no",
    "auto_recharge_100",
    "auto_recharge_250",
    "auto_recharge_500",
    "agent_receive_communications",
    "agent_send_communications",
    "alert_notification_email",
    "alert_notification_text",
    "idle_preference_time",
    "twofa",
    "subscriptions_num",
    "subscriptions_state"
    ];
}
