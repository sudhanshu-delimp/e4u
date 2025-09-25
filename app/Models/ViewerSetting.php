<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewerSetting extends Model
{
    use HasFactory;

    protected $table = "viewer_settings";
    protected $fillable = [
    'user_id',
    'user_type', 
    'advertiser_email', 
    'advertiser_text',
    
    'escort_email',
    'escort_text',
   
    'twofa',
    'idle_preference_time',

    'features_push_notifications_from_escorts',
    'features_direct_chatting_with_escorts',
    'features_write_reviews',
    'features_enable_my_legbox',
    'features_enable_my_notebox',

    'listings_preferences_view',

    'interests_with_male',
    'interests_with_female',
    'interests_with_trans',
    'interests_with_cross_dresser',
    'interests_with_couples',



];
}
