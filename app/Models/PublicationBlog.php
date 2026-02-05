<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicationBlog extends Model
{
    use HasFactory;
    protected $table = 'publication_blogs';
    
    protected $fillable = [
        'title',
        'slug',
        'blog_image',
        'description',
        'meta_title',
        'meta_description',
        'status',
    ];
}
