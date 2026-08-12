<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
//use Illuminate\Database\Eloquent\Model;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
class Masseur extends Model
{
    use HasFactory;

    protected $casts = [
    'service' => 'array',
    'massage_service_types'=>'array',
    'other_service_types' => 'array'
    ];
  
public function getProfileImgAttribute()
{
    $imageUrl = asset($this->getImagePosition(1, $this->id));

    if (Str::contains($imageUrl, 'mcc-default-thumbnail.png') || empty($imageUrl)) {
        return asset('assets/app/img/def-masseur-therapy.avif');
    }

    return $imageUrl;
}

    public function durations()
    {
        return $this->belongsToMany('App\Models\Duration','masseur_rate','masseur_profile_id','duration_id')->withPivot('massage_price','incall_price','outcall_price');
    }

    public function durationRate($duration_id, $duration_type)
    {
        if($duration = $this->durations()->where('duration_id',$duration_id)->first()) {
            return $duration->pivot->{$duration_type};
        }

        return null;
    }

    public function getMobileAttribute($value)
    {
      return formatMobileNumber($value);
    }


    public function getImagePosition($val,$profile_id)
    {

        if($val == 1)
        {
                $image = DB::table('massuers_media')
                                    ->join('masseur_galleries', 'massuers_media.id', '=', 'masseur_galleries.masseur_media_id')
                                    ->where('masseur_galleries.masseur_profile_id', $profile_id)
                                    ->where('masseur_galleries.position', $val)
                                    ->orderBy('masseur_galleries.id', 'desc')
                                    ->select('massuers_media.*')
                                    ->first();

                if($image) 
                return $image->path;
                else
                return url('assets/app/img/mcc-default-thumbnail.png');
              

        }

        else
        {
                $image = DB::table('massuers_media')
                                    ->join('masseur_galleries', 'massuers_media.id', '=', 'masseur_galleries.masseur_media_id')
                                    ->where('masseur_galleries.masseur_profile_id', $profile_id)
                                    ->where('masseur_galleries.position', $val)
                                    ->orderBy('masseur_galleries.id', 'desc')
                                    ->select('massuers_media.*')
                                    ->first();

                if($image) 
                return $image->path;
                else
                return url('assets/app/img/frame-main-thum.png');
              

        }

    }

    public function getImageDetailsByPosition($val,$profile_id)
    {

        if($val == 1)
        {
                $image = DB::table('massuers_media')
                                    ->join('masseur_galleries', 'massuers_media.id', '=', 'masseur_galleries.masseur_media_id')
                                    ->where('masseur_galleries.masseur_profile_id', $profile_id)
                                    ->where('masseur_galleries.position', $val)
                                    ->orderBy('masseur_galleries.id', 'desc')
                                    ->select('massuers_media.*')
                                    ->first();

                if($image) 
                return $image;
                else
                return [];
              

        }

        else
        {
                $image = DB::table('massuers_media')
                                    ->join('masseur_galleries', 'massuers_media.id', '=', 'masseur_galleries.masseur_media_id')
                                    ->where('masseur_galleries.masseur_profile_id', $profile_id)
                                    ->where('masseur_galleries.position', $val)
                                    ->orderBy('masseur_galleries.id', 'desc')
                                    ->select('massuers_media.*')
                                    ->first();

                if($image) 
                return $image;
                else
                return [];
              

        }

    }

     public function imagePosition($val, $defaultPositionImages = [])
    {
        if($val == 1){
            if($image = $this->gallary()->wherePivot('position', $val)->first()) {
                return $image->path;
            } /*elseif(isset($defaultPositionImages[$val])) {
                return $defaultPositionImages[$val]->path;
            } */else {
                return url('assets/app/img/mcc-default-thumbnail.png');
            }
            //return url('assets/app/img/upload-thum-1.png');
        } elseif(in_array($val, [2,3,4,5,6,7])){
            if($image = $this->gallary()->wherePivot('position', $val)->first()) {
                return $image->path;
            } /*elseif(isset($defaultPositionImages[$val])) {
                return $defaultPositionImages[$val]->path;
            } */else {
                return url('assets/app/img/frame-main-thum.png');
            }
            //return url('assets/app/img/upload-thum-1.png');
        } elseif($val == 8) {
            if($image = $this->gallary()->wherePivot('position', 8)->first()) {
                return $image->path;
            } else {
                return url('assets/app/img/upload-6.png');
            }
            //return url('assets/app/img/upload-6.png');
        }
        elseif($val == 9) {
            if($image = $this->gallary()->wherePivot('position', 9)->first()) {
                return $image->path;
            } /*elseif(isset($defaultPositionImages[$val])) {
                return $defaultPositionImages[$val]->path;
            }*/ else {
                return url('assets/app/img/upload-3.png');
            }
        }
        elseif($val == 10) {
            if($image = $this->gallary()->wherePivot('position', 10)->first()) {
                return $image->path;
            } else {
                //return url('assets/app/img/upload-6.png');
                return url('assets/app/img/upload-manage-video.png');
            }
        }
        else {
            if($image = $this->gallary()->wherePivot('position', $val)->first()) {
                return $image->path;
            } else {
                return url('assets/app/img/frame_final.png');
            }
        }

    }


    

    public function gallary()
    {
        return $this->belongsToMany('App\Models\MasseurMedia','masseur_galleries','masseur_profile_id','masseur_media_id')->withPivot('position');
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
