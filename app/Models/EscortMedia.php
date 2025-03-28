<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EscortMedia extends Model
{
    protected $guarded = ['id'];

    protected $table = 'escorts_medias';

    public function getThumbnailAttribute()
    {
        if($thumbnail = $this->thumbnails()->first()) {
            return $thumbnail->path;
        }

        return null;
    }

    public function thumbnails()
    {
        return $this->hasMany('App\Models\Thumbnail', 'media_id')->where('model', 'App\Models\EscortMedia');
    }

    
}
