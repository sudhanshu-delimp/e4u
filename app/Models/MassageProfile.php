<?php

namespace App\Models;
//use App\Models\State;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class MassageProfile extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = [
        //'play_type' => 'array',
        'language' => 'array',
        'social_links' => 'array',
        'available_to' => 'array',
    ];
    public function getGenderAttribute($value)
    {
         switch($value)
         {
             case(6): return "Female";  break;
             case(1): return "Male";  break;
             case(2): return "Couples";  break;
             case(3): return "Transgender";  break;
             case(4): return "Cross Dresser";  break;
             case(5): return "Massage Centres";  break;
         }
         
    }
    
    
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City','city_id');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country','country_id');
    }

    public function nationality()
    {
        return $this->belongsTo('App\Models\Country','nationality_id');
    }


    public function state()
    {
        return $this->belongsTo('App\Models\State','state_id');
    }

    public function nation()
    {
        return $this->belongsTo('App\Models\Country','nationality_id');
    }
    public function massage_services()
    {
        return $this->hasMany('App\Models\MassageService','massage_profile_id');
    }

    public function services()
    {
        return $this->belongsToMany('App\Models\Service', 'massage_services', 'massage_profile_id', 'service_id')->withPivot('price');
    }

    public function durations()
    {
        return $this->belongsToMany('App\Models\Duration','massage_rate','massage_profile_id','duration_id')->withPivot('massage_price','incall_price','outcall_price');
    }
    public function gallary()
    {
        return $this->belongsToMany('App\Models\MassageMedia','massage_gallery','massage_profile_id','massage_media_id')->withPivot('position');
    }

    public function durationRate($duration_id, $duration_type)
    {
        if($duration = $this->durations()->where('duration_id',$duration_id)->first()) {
            return $duration->pivot->{$duration_type};
        }

        return null;
    }

    public function availability()
    {
        return $this->hasOne('App\Models\MassageAvailability','massage_profile_id');
    }

    public function availabilityFromHour($day)
    {
        if(!$availability = $this->availability) {
            $availability = $this->availability()->make();
        }

        if($attribute =  $availability->{$day.'_from'}) {
            return Carbon::createFromFormat('H:i:s', $attribute)->format('h');
        }

        return null;
    }

    public function availabilityToHour($day)
    {
        if(!$availability = $this->availability) {
            $availability = $this->availability()->make();
        }

        if($attribute =  $availability->{$day.'_to'}) {
            return Carbon::createFromFormat('H:i:s', $attribute)->format('h');
        }

        return null;
    }

    public function availabilityFromMinute($day)
    {
        if(!$availability = $this->availability) {
            $availability = $this->availability()->make();
        }

        if($attribute =  $availability->{$day.'_from'}) {
            return Carbon::createFromFormat('H:i:s', $attribute)->format('i');
        }

        return null;
    }

    public function availabilityToMinute($day)
    {
        if(!$availability = $this->availability) {
            $availability = $this->availability()->make();
        }

        if($attribute =  $availability->{$day.'_to'}) {
            return Carbon::createFromFormat('H:i:s', $attribute)->format('i');
        }

        return null;
    }

    public function availabilityFromA($day)
    {
        if(!$availability = $this->availability) {
            $availability = $this->availability()->make();
        }
        if($attribute =  $availability->{$day.'_from'}) {
            return Carbon::createFromFormat('H:i:s', $attribute)->format('A');
        }

        return null;
    }

    public function availabilityToA($day)
    {
        if(!$availability = $this->availability) {
            $availability = $this->availability()->make();
        }
        if($attribute =  $availability->{$day.'_to'}) {
            return Carbon::createFromFormat('H:i:s', $attribute)->format('A');
        }

        return null;
    }

    public function scopeServiceWithPrice($q, $id, $service_id)
    {
        return $q->whereHas('services', function($q) use($id, $service_id) {
            $q->where('escort_id', $id)
            ->where('service_id', $service_id);
        });
    }

    public function medias()
    {
        return $this->hasMany('App\Models\MassageMedia', 'user_id');
    }
    public function messages()
    {
        return $this->hasMany('App\Models\EscortMessages', 'escort_id');
    }

    public function images()
    {
        return $this->hasMany('App\Models\MassageMedia', 'user_id')->where('type', 0);
    }

    public function videos()
    {
        return $this->hasMany('App\Models\MassageMedia', 'user_id')->where('type', 1);
    }

    public function getLastVedioAttribute()
    {
        if($vedio = $this->medias()->where('type', 1)->orderBy('id','DESC')->first()) {
            
            return url($vedio->path);
        }
        //return null;
    }

    // public function defaultImagesMassageCenter()
	// {
        
    //     if($image = $this->gallary()->where('user_id',auth()->user()->id)->wherePivot('position','!=',null)->get()) {
    //         return $image;
    //     } else {
    //         return url('assets/app/img/upload-1.png');
    //     }
    //     return $result;
	// }
    public function imagePosition($val)
    {
        if($val == 1){

            if($image = $this->gallary()->wherePivot('position', 1)->first()) {
                return $image->path;
            } else {
                return url('assets/app/img/upload-thum-1.png');
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
            } else {
                return url('assets/app/img/upload-3.png');
            }
        }
        elseif($val == 10) {
            if($image = $this->gallary()->wherePivot('position', 10)->first()) {
                return $image->path;
            } else {
                return url('assets/app/img/upload-6.png');
            }
        }
        else {
            if($image = $this->gallary()->wherePivot('position', $val)->first()) {
                return $image->path;
            } else {
                return url('assets/app/img/frame-main-thum.png');
            }
        }

    }
    public function imagefrontPosition($val)
    {
        if($val == 1){

            if($image = $this->gallary()->wherePivot('position', 1)->first()) {
                return $image->path;
            } else {
                return url('assets/app/img/upload-manage.png');//asset('assets/app/img/service-provider/Frame-408.png')
            }
        } elseif($val == 8) {
            if($image = $this->gallary()->wherePivot('position', 8)->first()) {
                return $image->path;
            } else {
                return url('assets/app/img/upload-6.png');
            }
        }
        elseif($val == 9) {
            if($image = $this->gallary()->wherePivot('position', 9)->first()) {
                return $image->path;
            } else {
                return url('assets/app/img/upload-3.png');
            }
        }
        elseif($val == 10) {
            if($image = $this->gallary()->wherePivot('position', 10)->first()) {
                return $image->path;
            } elseif($image = $this->gallary()->wherePivot('position', 8)->first()) {
                return $image->path;
            }
             else {
                return url('assets/app/img/upload-6.png');
            }
        }
        else {
            if($image = $this->gallary()->wherePivot('position', $val)->first()) {
                return $image->path;
            } else {
                //return url('assets/app/img/upload-2.png');//wherePivotwherePivot
                return url('assets/app/img/upload_pic.png');//wherePivotwherePivot
            }
        }

    }
    // public function getDefaultImageAttribute()
    // {
    //     if($image = $this->images()->where('default', 1)->first()) {
    //         return url($image->path);
    //     }

    //     if($image = $this->images()->first()) {
    //         return url($image->path);
    //     } else {
    //         return url('assets/app/img/service-provider/Frame-408.png');
    //     }
    // }

    public function getBannerImageAttribute()
    {
        if($image = $this->medias()->where('type', 2)->orderBy('id','DESC')->first()) {
            return url($image->path);
        }
        return null;
    }

    public function getBannerVideoAttribute()
    {
        if($image = $this->medias()->where('type', 3)->first()) {
            return url($image->path);
        }
        return null;
    }

    public function playmates()
    {
        return $this->belongsToMany(Escort::class, 'playmates', 'escort_id', 'playmate_id');
    }

    public function getMemberIdAttribute()
    {
        return $this->user->member_id;
    }

    public function covidReport()
    {
        return $this->hasOne('App\Models\EscortCovidReport', 'escort_id', 'id');
    }

    public function massageShortListed()
    {
        return $this->belongsToMany(User::class, 'Add_to_massage_sortlist', 'massage_id', 'user_id');
    }
    
    public function locations()
    {
        return $this->belongsToMany('App\Models\City', 'tour_location', 'profile_id', 'city_id');
    }
}
