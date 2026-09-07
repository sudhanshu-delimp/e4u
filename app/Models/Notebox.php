<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notebox extends Model
{
    use HasFactory;
    protected $table = 'notebox';

    protected $fillable = [
        'escort_type',
        'stage_name',
        'mobile',
        'advertised_price_per_hour',
        'state',
        'location',
        'extras_charged',
        'meeting_type',
        'photos_authenticity',
        'ethnicity',
        'nationality',
        'estimated_age',
        'body_shape',
        'overall_looks',
        'overall_personality',
        'bd',
        'blowjob',
        'oral_on_escort',
        'anal_sex',
        'overall_performance',
        'met_profile_undertakings',
        'drug_consumption',
        'platform',
        'profile_link',
        'summary_of_encounter',
        'profile_pic',
        'status_type',
        'status',
        'admin_action',
        'admin_id',
        'rating',
    ];
}
