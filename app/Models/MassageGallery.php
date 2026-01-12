<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MassageGallery extends Model
{
    use HasFactory;
    
    protected $table = "massage_gallery";
    protected $guarded = ['id'];

    public function media()
    {
        return $this->belongsTo(MassageMedia::class, 'massage_media_id', 'id');
    }
}
