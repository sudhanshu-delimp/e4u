<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EscortGallery extends Model
{
    use HasFactory;
    
    protected $table = "escort_gallery";
    protected $guarded = ['id'];
}
