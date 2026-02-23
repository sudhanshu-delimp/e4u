<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MassageStatistics extends Model
{
    use HasFactory;

    protected $table = 'massage_reviews';

    protected $fillable = [
        'id',
        'user_id',
        'massage_id',
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
