<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MassageGallery extends Model
{
    use HasFactory;
    
    protected $table = "massage_gallery";
    protected $guarded = ['id'];
}
