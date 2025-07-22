<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EscortViewerInteractions extends Model
{
    use HasFactory;
    protected $table = 'escort_viewer_interactions';
    
    protected $fillable = ['user_id', 'escort_id', 'viewer_id', 'action_by', 'escort_blocked_viewer', 'escort_disabled_contact', 'escort_disabled_notification', 'viewer_blocked_escort','viewer_disabled_contact','viewer_disabled_notification','viewer_rate_escort'];
}
