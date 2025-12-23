<?php

namespace App\Models;
//use App\Models\State;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Escort extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = [
        'play_type' => 'array',
        'language' => 'array',
        'social_links' => 'array',
        'available_to' => 'array',
    ];

    protected $dates = ['start_date', 'end_date'];


    public function getPhoneAttribute($value)
    {
      return formatMobileNumber($value);
    }

    public function setPhoneAttribute($value)
    {
    
        $clean = removeSpaceFromString($value);
        $this->attributes['phone'] = $clean;
    }

    public function setStartDateAttribute($value)
    {
        if (empty($value)) {
            $this->attributes['start_date'] = null;
            return;
        }

        try {
            $date = Carbon::createFromFormat('d-m-Y', $value);
        } catch (\Exception $e) {
            $date = Carbon::parse($value);
        }
        $this->attributes['start_date'] = $date->format('Y-m-d');
    }


    public function setEndDateAttribute($value)
    {
        if (empty($value)) {
            $this->attributes['end_date'] = null;
            return;
        }

        try {
            $date = Carbon::createFromFormat('d-m-Y', $value);
        } catch (\Exception $e) {
            $date = Carbon::parse($value);
        }

        $this->attributes['end_date'] = $date->format('Y-m-d');
    }

    public function getStartDateFormattedAttribute()
    {
        return $this->start_date
            ? Carbon::parse($this->start_date)->format('d-m-Y')
            : null;
    }
    public function getEndDateFormattedAttribute()
    {
        return $this->end_date
            ? Carbon::parse($this->end_date)->format('d-m-Y')
            : null;
    }

    public function getGenderTypeAttribute($value)
    {
         switch($this->gender)
         {
             case("Female"): return 6;  break;
             case("Male"): return 1;  break;
             case("Couples"): return 2;  break;
             case("Transgender"): return 3;  break;
             case("Cross Dresser"): return 4;  break;
             case("Massage Centres"): return 5;  break;
         }

    }

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

    public function getCovidreportAttribute($value)
    {
         switch($value)
         {
             case(1): return "Vaccinated, not up to date";  break;
             case(2): return "Vaccinated, up to date";  break;
             case(3): return "Not Vaccinated";  break;

         }

    }
    public function getMembershipTypeAttribute($value)
    {

         switch($this->membership)
         { 
             case(1): return "Platinum";  break;
             case(2): return "Gold";  break;
             case(3): return "Silver";  break;
             case(4): return "Free";  break;

         }

    }

    public function getNameWithProfileNameAttribute()
    {
        return $this->name . ' (' . $this->profile_name . ')';
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function myLegBox()
    {
        return $this->hasOne(MyLegbox::class, 'escort_id', 'id')
                ->where('user_id', auth()->id());
    }

    public function viewerLegBox()
    {
        return $this->hasOne(MyLegbox::class, 'escort_id', 'id');
    }

    public function purchase()
    {
        return $this->hasMany(Purchase::class, 'escort_id','id');
    }

    public function mainPurchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }

    public function isListingExtended(){
        $purchases = $this->purchase()
        ->where('utc_end_time', '>=', Carbon::now('UTC'))
        ->orderBy('utc_end_time', 'desc')
        ->get();
        return (object)[
            'count' => $purchases->count() > 1,
            'data' => $purchases->first()
        ];
    }

    public function brb()
    {
        return $this->hasMany('App\Models\EscortBrb', 'profile_id');
    }

    public function pinup()
    {
        return $this->hasMany('App\Models\EscortPinup', 'escort_id');
    }

    public function latestActivePinup(){
        return $this->hasOne(EscortPinup::class)
        ->where('utc_end_time', '>=', Carbon::now('UTC'))
        ->latestOfMany('utc_end_time');
    }

    public function currentActivePinup(){
        return $this->hasOne(EscortPinup::class)
        ->where('utc_start_time', '<=', Carbon::now('UTC'))
        ->where('utc_end_time', '>=', Carbon::now('UTC'))
        ->latestOfMany('utc_end_time');
    }
    
    public function suspendProfile()
    {
        return $this->hasMany(SuspendProfile::class, 'escort_profile_id');
    }

    public function activeSuspendProfile()
    {
        return $this->hasMany(SuspendProfile::class, 'escort_profile_id')
        ->where('utc_start_date', '<=', Carbon::now('UTC'))
        ->where('utc_end_date', '>=', Carbon::now('UTC'));
    }

    public function activeUpcomingSuspend(){
        return $this->hasOne(SuspendProfile::class, 'escort_profile_id')
        ->where('utc_end_date', '>=', Carbon::now('UTC'))
        ->latestOfMany('utc_end_date');
    }
    
    public function latestActiveBrb(): HasOne
    {
        return $this->hasOne(EscortBrb::class, 'profile_id', 'id')
            ->where('brb_time', '>', Carbon::now('UTC'))
            ->where('active', 'Y')
            ->orderBy('brb_time', 'desc');
    }

    public function likes()
    {
        return $this->hasMany(EscortLike::class, 'escort_id');
        //return $this->belongsTo('App\Models\EscortLike', 'escort_id');
    }

    public function payments()
    {
        return $this->belongsTo('App\Models\Payment','referenceId');
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

    public function services()
    {
        return $this->belongsToMany('App\Models\Service', 'escort_services', 'escort_id', 'service_id')->withPivot('price');
    }

    public function durations()
    {
        return $this->belongsToMany('App\Models\Duration','escort_rate','escort_id','duration_id')->withPivot('escort_id','duration_id', 'massage_price','incall_price','outcall_price');
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
        return $this->hasOne('App\Models\Availability','escort_id');
    }

    public function pricing()
    {
        return $this->belongsTo('App\Models\Pricing', 'membership', 'membership_id');
    }

    /***
     * @CreatedOn: 14-Jul-2023
     * @By:Bikash Chhualsingh
     *
     * @param $day
     * @param string $type from, to
     * @return string|null
     */
    public function availabilityCheck($day, $type = 'from')
    {
        if(!$availability = $this->availability) {
            $availability = $this->availability()->make();
        }

        if($attribute =  $availability->{$day.'_'.$type}) {
            return Carbon::createFromFormat('H:i:s', $attribute)->format('h:i');
        }
        return null;
    }

    /***
     * @CreatedOn: 14-Jul-2023
     * @By:Bikash Chhualsingh
     *
     * @param $day
     * @param string $type from, to
     * @return string|null
     */
    public function availabilityCheckAMorPM($day, $type='from')
    {
        if(!$availability = $this->availability) {
            $availability = $this->availability()->make();
        }
        if($attribute =  $availability->{$day.'_'.$type}) {
            return Carbon::createFromFormat('H:i:s', $attribute)->format('A');
        }

        return null;
    }


    //Not required as availabilityCheck() added for code readability
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

    //Not required as availabilityCheck() added for code readability
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

    //Not required as availabilityCheck() added for code readability
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

    //Not required as availabilityCheck() added for code readability
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

    //Not required as availabilityCheckAMorPM() added for code readability
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

    //Not required as availabilityCheckAMorPM() added for code readability
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
        return $this->hasMany('App\Models\EscortMedia', 'escort_id');
    }
    public function messages()
    {
        return $this->hasMany('App\Models\EscortMessages', 'escort_id');
    }

    public function images()
    {
        return $this->hasMany('App\Models\EscortMedia', 'escort_id')->where('type', 0);
    }

    public function videos()
    {
        return $this->hasMany('App\Models\EscortMedia', 'user_id','user_id')->where('type', 1);
    }

    public function escort_videos()
    {
        return $this->belongsToMany('App\Models\EscortMedia','escort_gallery','escort_id','escort_media_id')
                    ->withPivot('position', 'type')
                    ->wherePivot('type', 1);
    }


   
    

    public function getLastVedioAttribute()
    {
        if($vedio = $this->medias()->where('type', 1)->orderBy('id','DESC')->first()) {

            return url($vedio->path);
        }
        //return null;
    }

    public function getDefaultImageAttribute()
    {
        if($image = $this->gallary()->wherePivot('position', 1)->first()) {
            //dd(url($image->path));
            return url($image->path);
        }


        // if($image = $this->images()->where('default', 1)->first()) {
        //             return url($image->path);
        // }

        // if($image = $this->images()->first()) {
        //     return url($image->path);
        // } else {
        //     return url('assets/app/img/service-provider/Frame-408.png');
        // }
    }

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
        return $this->belongsToMany(
            Escort::class,
            'escort_playmate',
            'escort_id',
            'playmate_id'
        )->withTimestamps()
        ->whereDoesntHave('activeSuspendProfile');
    }

    public function playmateHistory()
    {
        return $this->hasMany(
            PlaymateHistory::class,
            'escort_id',
        );
    }

    public function addedBy()
    {
        return $this->belongsToMany(
            Escort::class,
            'escort_playmate',
            'playmate_id',
            'escort_id'
        );
    }

    public function getMemberIdAttribute()
    {
        return $this->user->member_id;
    }

    public function covidReport()
    {
        return $this->hasOne('App\Models\EscortCovidReport', 'escort_id', 'id');
    }

    public function shortListed()
    {
        return $this->belongsToMany(User::class, 'add_to_list', 'escort_id', 'user_id');
    }

    public function locations()
    {
        return $this->belongsToMany('App\Models\City', 'tour_location', 'profile_id', 'city_id');
    }

    public function reviews()
    {
        return $this->hasMany(Reviews::class, 'escort_id', 'id');
    }

    ///////////////////
    public function gallary()
    {
        return $this->belongsToMany('App\Models\EscortMedia','escort_gallery','escort_id','escort_media_id')->withPivot('position');
    }

    // public function imageGallery()
    // {
    //     return $this->gallary()
    //     ->where('escort_gallery.type', 0)
    //     ->whereBetween('escort_gallery.position', [1, 7])
    //     ->orderBy('escort_gallery.position', 'asc');
    // }

    public function imagePosition($val, $defaultPositionImages = [])
    {
        if($val == 1){
            if($image = $this->gallary()->wherePivot('position', $val)->first()) {
                return $image->path;
            } /*elseif(isset($defaultPositionImages[$val])) {
                return $defaultPositionImages[$val]->path;
            } */else {
                return url('assets/app/img/upload-thum-1.png');
            }
            //return url('assets/app/img/upload-thum-1.png');
        } elseif(in_array($val, [2,3,4,5,6,7])){
            if($image = $this->gallary()->wherePivot('position', $val)->first()) {
                return $image->path;
            } /*elseif(isset($defaultPositionImages[$val])) {
                return $defaultPositionImages[$val]->path;
            } */else {
                return url('assets/app/img/frame_final.png');
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
    public function publicImageOnePosition()
    {
        $image = $this->gallary()->wherePivot('position', 1)->first();
        return $image->path;

    }
    public function imagefrontPosition($val, $defaultPositionImages = [])
    {
        if($val == 1){
            if($image = $this->gallary()->wherePivot('position', $val)->first()) {
                return $image->path;
            } /*elseif(isset($defaultPositionImages[$val])) {
                return $defaultPositionImages[$val]->path;
            } */else {
                return url('assets/app/img/upload-manage.png');//asset('assets/app/img/service-provider/Frame-408.png')
            }
        } elseif(in_array($val, [2,3,4,5,6,7])){
            if($image = $this->gallary()->wherePivot('position', $val)->first()) {
                return $image->path;
            } /*elseif(isset($defaultPositionImages[$val])) {
                return $defaultPositionImages[$val]->path;
            } */else {
                return url('assets/app/img/upload_pic.png');//wherePivotwherePivot
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
            } /*elseif(isset($defaultPositionImages[$val])) {
                return $defaultPositionImages[$val]->path;
            } */else {
                return url('assets/app/img/upload-3.png');
            }
        }
        elseif($val == 10) {
            if($image = $this->gallary()->wherePivot('position', 10)->first()) {
                return $image->path;
            }
             else {
                return url('assets/app/img/upload-manage-video.png');
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

    public function escortViewerInteraction()
    {
        // relation used for viewer only
        return $this->hasOne(EscortViewerInteractions::class, 'escort_id','id')->where('viewer_id', Auth::user()->id);
    }

    public function tourProfiles()
    {
        return $this->hasMany(TourProfile::class,'escort_id');
    }

    public function getDaysNumberAttribute()
    {
        return Carbon::parse($this->start_date)
              ->diffInDays(Carbon::parse($this->end_date))+1;
    }
    public function getDaysLeftAttribute()
    {
        return Carbon::parse(now())
              ->diffInDays(Carbon::parse($this->end_date))+1;
    }
}
