<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasseurGallery extends Model
{
    use HasFactory;

   
    
    protected $table = "masseur_galleries";
    protected $guarded = ['id'];

    public function media()
    {
        return $this->belongsTo(MasseurMedia::class, 'masseur_media_id', 'id');
    }

}
