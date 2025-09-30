<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EscortStatistics extends Model
{
    use HasFactory;

    protected $table = 'escort_statistics';

    protected $fillable = [
        'id',
        'user_id',
        'escort_id',
        'date',
        'profile_views_count',
        'media_views_count',
        'playbox_views_count',
        'reviews_count',
        'recommendation_count',
        'created_at',
        'updated_at'
    ];

    
}
