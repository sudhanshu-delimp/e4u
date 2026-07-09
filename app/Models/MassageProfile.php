<?php

namespace App\Models;
//use App\Models\State;

use App\Models\Escort;
use App\Models\MassageBrb;
use App\Models\MassageBumpup;
use App\Models\MassageLike;
use App\Models\MassagePurchase;
use App\Models\MassageSuspendProfile;
use App\Models\MassageViewerInteractions;
use App\Models\Masseur;
use App\Models\MyMassageLegbox;
use App\Models\Reviews;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use App\Models\Model;
use Illuminate\Support\Facades\Log;

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
        switch ($value) {
            case (6):
                return "Female";
                break;
            case (1):
                return "Male";
                break;
            case (2):
                return "Couples";
                break;
            case (3):
                return "Transgender";
                break;
            case (4):
                return "Cross Dresser";
                break;
            case (5):
                return "Massage Centres";
                break;
        }
    }


    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function massagerMasseurs()
    {
        return $this->belongsToMany(
            Masseur::class,
            'massager_masseurs',
            'massage_profile_id',
            'masseur_profile_id'
        );
    }

    public function likes()
    {
        return $this->hasMany(MassageLike::class, 'massage_id');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id');
    }

    public function nationality()
    {
        return $this->belongsTo('App\Models\Country', 'nationality_id');
    }
    public function getPhoneAttribute($value)
    {
        return formatMobileNumber($value);
    }

     public function getBusinessNoAttribute($value)
    {
      return formatMobileNumber($value);
    }

    public function state()
    {
        return $this->belongsTo('App\Models\State', 'state_id');
    }

    public function nation()
    {
        return $this->belongsTo('App\Models\Country', 'nationality_id');
    }
    public function massage_services()
    {
        return $this->hasMany('App\Models\MassageService', 'massage_profile_id');
    }

    public function services()
    {
        return $this->belongsToMany('App\Models\Service', 'massage_services', 'massage_profile_id', 'service_id')->withPivot('price');
    }

    public function durations()
    {
        return $this->belongsToMany('App\Models\Duration', 'massage_rate', 'massage_profile_id', 'duration_id')->withPivot('massage_price', 'incall_price', 'outcall_price');
    }
    public function gallary()
    {
        return $this->belongsToMany('App\Models\MassageMedia', 'massage_gallery', 'massage_profile_id', 'massage_media_id')->withPivot('position');
    }

    public function durationRate($duration_id, $duration_type)
    {
        if ($duration = $this->durations()->where('duration_id', $duration_id)->first()) {
            return $duration->pivot->{$duration_type};
        }

        return null;
    }

    public function availability()
    {
        return $this->hasOne('App\Models\MassageAvailability', 'massage_profile_id');
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

    public function availabilityFromHour($day)
    {
        if (!$availability = $this->availability) {
            $availability = $this->availability()->make();
        }

        if ($attribute =  $availability->{$day . '_from'}) {
            return Carbon::createFromFormat('H:i:s', $attribute)->format('h');
        }

        return null;
    }

    public function availabilityToHour($day)
    {
        if (!$availability = $this->availability) {
            $availability = $this->availability()->make();
        }

        if ($attribute =  $availability->{$day . '_to'}) {
            return Carbon::createFromFormat('H:i:s', $attribute)->format('h');
        }

        return null;
    }

    public function availabilityFromMinute($day)
    {
        if (!$availability = $this->availability) {
            $availability = $this->availability()->make();
        }

        if ($attribute =  $availability->{$day . '_from'}) {
            return Carbon::createFromFormat('H:i:s', $attribute)->format('i');
        }

        return null;
    }

    public function availabilityToMinute($day)
    {
        if (!$availability = $this->availability) {
            $availability = $this->availability()->make();
        }

        if ($attribute =  $availability->{$day . '_to'}) {
            return Carbon::createFromFormat('H:i:s', $attribute)->format('i');
        }

        return null;
    }

    public function availabilityFromA($day)
    {
        if (!$availability = $this->availability) {
            $availability = $this->availability()->make();
        }
        if ($attribute =  $availability->{$day . '_from'}) {
            return Carbon::createFromFormat('H:i:s', $attribute)->format('A');
        }

        return null;
    }

    public function availabilityToA($day)
    {
        if (!$availability = $this->availability) {
            $availability = $this->availability()->make();
        }
        if ($attribute =  $availability->{$day . '_to'}) {
            return Carbon::createFromFormat('H:i:s', $attribute)->format('A');
        }

        return null;
    }

    public function scopeServiceWithPrice($q, $id, $service_id)
    {
        return $q->whereHas('services', function ($q) use ($id, $service_id) {
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

    public function messageViewerInteraction()
    {
        return $this->hasOne(MassageViewerInteractions::class, 'massage_id');
    }

    public function messageViewerLegbox()
    {
        return $this->hasOne(MyMassageLegbox::class, 'massage_id');
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
        if ($vedio = $this->medias()->where('type', 1)->orderBy('id', 'DESC')->first()) {

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
        if ($val == 1) {

            if ($image = $this->gallary()->wherePivot('position', 1)->first()) {
                return $image->path;
            } else {
                return url('assets/app/img/img-11.png');
            }
            //return url('assets/app/img/upload-thum-1.png');
        } elseif ($val == 8) {
            if ($image = $this->gallary()->wherePivot('position', 8)->first()) {
                return $image->path;
            } else {
                return url('assets/app/img/upload-6.png');
            }
            //return url('assets/app/img/upload-6.png');
        } elseif ($val == 9) {
            if ($image = $this->gallary()->wherePivot('position', 9)->first()) {
                return $image->path;
            } else {
                return url('assets/app/img/img-13.png');
            }
        } elseif ($val == 10) {
            if ($image = $this->gallary()->wherePivot('position', 10)->first()) {
                return $image->path;
            } else {
                return url('assets/app/img/upload-6.png');
            }
        } else {
            if ($image = $this->gallary()->wherePivot('position', $val)->first()) {
                return $image->path;
            } else {
                return url('assets/app/img/img-12.png');
            }
        }
    }

    public function get_image_position_detail($val)
    {
        try {
            // Validate input (optional but safer)
            if (!is_numeric($val)) {
                return [];
            }

            $image = $this->gallary()
                        ->wherePivot('position', (int)$val)
                        ->first();

            return $image ? $image : [];

        } catch (\Exception $e) {
            // Log error for debugging
            \Log::error('Error in get_image_position_detail: ' . $e->getMessage());

            return [];
        }
    }


    public function imagefrontPosition($val)
    {
        if ($val == 1) {

            if ($image = $this->gallary()->wherePivot('position', 1)->first()) {
                return $image->path;
            } else {
                return url('assets/app/img/upload-manage.png'); //asset('assets/app/img/service-provider/Frame-408.png')
            }
        } elseif ($val == 8) {
            if ($image = $this->gallary()->wherePivot('position', 8)->first()) {
                return $image->path;
            } else {
                return url('assets/app/img/upload-6.png');
            }
        } elseif ($val == 9) {
            if ($image = $this->gallary()->wherePivot('position', 9)->first()) {
                return $image->path;
            } else {
                return url('assets/app/img/upload-3.png');
            }
        } elseif ($val == 10) {
            if ($image = $this->gallary()->wherePivot('position', 10)->first()) {
                return $image->path;
            } elseif ($image = $this->gallary()->wherePivot('position', 8)->first()) {
                return $image->path;
            } else {
                return url('assets/app/img/upload-6.png');
            }
        } else {
            if ($image = $this->gallary()->wherePivot('position', $val)->first()) {
                return $image->path;
            } else {
                //return url('assets/app/img/upload-2.png');//wherePivotwherePivot
                return url('assets/app/img/upload_pic.png'); //wherePivotwherePivot
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
        if ($image = $this->medias()->where('type', 2)->orderBy('id', 'DESC')->first()) {
            return url($image->path);
        }
        return null;
    }

    public function getBannerVideoAttribute()
    {
        if ($image = $this->medias()->where('type', 3)->first()) {
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

    public function reviews()
    {
        return $this->hasMany(Reviews::class, 'advertiser_id')
                    ->where('advertiser_type', 'massage');
    }

    public function getUserLikeDislike($massage_id, $ip, $userId)
    {
        $result = MassageLike::where('massage_id', $massage_id)
            ->whereBetween('created_at', [date('Y-m-d') . ' 00:00:00', date('Y-m-d') . ' 23:59:59']);
        $conditions = [
            ['ip_address', $ip]
        ];
        if ($userId) {
            $conditions[] = ['user_id', $userId];
        }
        $result = $result->where(function ($q) use ($ip, $userId) {
            $q->where('ip_address', $ip);
            if ($userId) {
                $q->orWhere('user_id', $userId);
            }
        })->first();

        return $result;
    }

    function getClientIP() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0]; 
        } elseif(isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        } elseif(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
        } elseif(isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } elseif(isset($_SERVER['HTTP_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        } elseif(isset($_SERVER['REMOTE_ADDR'])) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipaddress = 'UNKNOWN';
        }
        return $ipaddress;
    }



    public function brb()
    {
        return $this->hasMany('App\Models\MassageBrb', 'profile_id');
    }

    public function latest_active_brb()
    {
        return $this->hasOne(MassageBrb::class, 'profile_id', 'id')
            ->where('brb_time', '>', Carbon::now('UTC'))
            ->where('active', 'Y')
            ->orderBy('brb_time', 'desc');
    }


     public function suspendProfile()
    {
        return $this->hasMany(MassageSuspendProfile::class, 'massage_profile_id');
    }

    public function purchase()
    {
        return $this->hasMany(MassagePurchase::class, 'massage_profile_id','id');
    }

    public function latestPurchase()
    {
        return $this->hasOne(MassagePurchase::class, 'massage_profile_id', 'id')
        ->where('status', 'listed')
        ->latest('id');
        
    }


    public function mainPurchase()
    {
        return $this->belongsTo(MassagePurchase::class, 'purchase_id');
    }

    //  public function activeUpcomingSuspend(){
    //     return $this->hasOne(MassageSuspendProfile::class, 'massage_profile_id','id')
    //     ->where('utc_end_date', '>=', Carbon::now('UTC'))
    //     ->oldestOfMany('utc_start_date');
    // }

    public function activeUpcomingSuspend()
    {
        $now = now('UTC');
        return $this->hasOne(MassageSuspendProfile::class, 'massage_profile_id', 'id')
        ->where(function ($query) use ($now) {
                $query->where(function ($q) use ($now) {
                    $q->where('utc_start_date', '<=', $now)
                    ->where('utc_end_date', '>=', $now);
                })
                ->orWhere('utc_start_date', '>', $now);
            })
            ->orderBy('utc_start_date', 'asc');
    }

    // public function isListingExtended(){

             
    //     $purchases = $this->purchase()
    //     ->where('utc_end_time', '>=', Carbon::now('UTC'))
    //     ->where('parent_id',0)
    //     ->where('status','!=','cancel')
    //     ->orderBy('utc_end_time', 'desc')
    //     ->get();
    //     return (object)[
    //         'count' => $purchases->count() > 1,
    //         'data' => $purchases->first()
    //     ];
    // }

    public function isListingExtended()
    {
        $latestListed = $this->purchase()
            ->where('status', 'listed')
            ->orderByDesc('id')
            ->first();

        if (!$latestListed) {
            return false;
        }

         $purchases = $this->purchase()
        ->where('id', '>', $latestListed->id)
        ->where('status', 'pending')
        ->orderBy('id', 'asc')
        ->first();

        return (object) [
            'count' => ($purchases) ? true : false,
            'data' => $purchases,
        ];
    }

    public function activeBumpup()
    {
        return $this->hasOne(MassageBumpup::class, 'massage_id')
            ->latestOfMany('utc_start_time')
            ->active();
    }

}
