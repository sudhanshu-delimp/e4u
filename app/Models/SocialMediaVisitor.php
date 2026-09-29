<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMediaVisitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'social_link',
        'listing_profile_id',
        'visitorUuid',
        'user_id',
        'ip_address',
        'page',
        'platform',
        'device',
        'country',
        'state',
        'city',
        'landed',
        'idle',
        'origin',
        'date',
        'user_type',
    ];
}
