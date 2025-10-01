<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminBlog extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'slug', 'content', 'feature_image', 'meta_title', 'meta_description', 'meta_keywords',
        'status', 'published_at'
    ];

    protected $dates = ['published_at'];
}
