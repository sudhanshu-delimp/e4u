<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportEscortProfile extends Model
{
    use HasFactory;

    protected $table = 'report_escort_profiles';
    
    protected $fillable = ['id', 'escort_id', 'viewer_id', 'report_tag', 'report_desc', 'admin_id', 'report_status', 'action_message'];

}
