<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasseurMedia extends Model
{
    protected $guarded = ['id'];

    protected $table = 'massuers_media';

    public function getThumbnailAttribute()
    {
        if($thumbnail = $this->thumbnails()->first()) {
            return $thumbnail->path;
        }

        return null;
    }

    public function thumbnails()
    {
        return $this->hasMany('App\Models\Thumbnail', 'media_id')->where('model', 'App\Models\MasseurMedia');
    }

    
}
