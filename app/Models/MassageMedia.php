<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
use App\Models\Model;

class MassageMedia extends Model
{
    protected $guarded = ['id'];

    protected $table = 'massage_medias';

    public function getThumbnailAttribute()
    {
        if($thumbnail = $this->thumbnails()->first()) {
            return $thumbnail->path;
        }

        return null;
    }

    public function thumbnails()
    {
        return $this->hasMany('App\Models\Thumbnail', 'media_id')->where('model', 'App\Models\MassageMedia');
    }

    /**
     * Indicates if the model should have created_by and updated_by fields.
     *
     * @var bool
     */
    public $createdUpdatedBy = true;

    /**
     * Get the created by that owns the details.
     */
    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    /**
     * Get the updated by that owns the details.
     */
    public function updatedBy()
    {
        return $this->belongsTo('App\Models\User', 'updated_by');
    }
    
}
