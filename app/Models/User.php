<?php

namespace App\Models;

use Exception;
use App\Models\AgentDetail;
use App\Models\AgentSetting;
use App\Models\EscortSetting;
use App\Models\ViewerSetting;
use App\Models\AccountSetting;
use App\Models\MassageSetting;
use App\Models\AgentBankDetail;
use App\Models\PasswordSecurity;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use App\Models\ViewerNotificationSetting;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = ['id'];
    /*
        $fillable = [
        'name',
        'email',
        'password',
        'enabled',
    ];
    */

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',

    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_online_at' => 'datetime',
        'social_links' => 'array',
        'contact_type' => 'array',
        'escorts_names' => 'array',
        'viewer_contact_type' => 'array',
        'tour_permissition_type' => 'array',
        'alert_notifications' => 'array',
        'profile_creator' => 'array',
        'agent_communications' => 'array',
        'notification_features' => 'array',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'online',
        'member_id',
    ];

    public function getTypeAttribute($value)
    {
        return (int) $value;
    }

    public function getOnlineAttribute()
    {
        if (!$this->last_online_at) return false;

        if ($this->last_online_at->diffInMinutes(now()) < 2) {
            return true;
        }
        return false;
    }

    public function getStatusAttribute($value)
    {
        $map = [
            '1' => 'Active',
            '2' => 'Pending',
            '3' => 'Suspended',
            '4' => 'Blocked',
            '5' => 'Registered',
            '6' => 'On Hold',
            '7' => 'Rejected',
            '8' => 'Cancelled',
        ];

        return $map[$value] ?? 'Unknown';
    }

    public function findRole($role)
    {
        switch ($role) {

            case 'user':
                $type = 0;
                break;

            case 'admin':
                $type = 1;
                break;

            case 'sub-admin':
                $type = 2;
                break;

            case 'escort':
                $type = 3;
                break;

            case 'massage-center':
                $type = 4;
                break;

            case 'agents':
                $type = 5;
                break;
            case 'staff':
                $type = 6;
                break;

            default:
                $type = 0;
                break;
        }

        return $type;
    }

    public function getRoleTypeAttribute()
    {

        switch ($this->type) {

            case (0):
                return 'User';
                break;

            case (1):
                return "Admin";
                break;

            case (2):
                return "Sub-Admin";
                break;

            case (3):
                return "Escort";
                break;

            case (4):
                return "Massage-Center";
                break;

            case (5):
                return "Agents";
                break;
            case (6):
                return "Staff";
                break;
        }
    }
    public function getUserTypeAttribute()
    {

        switch ($this->type) {

            case (0):
                return 'V';
                break;

            case (1):
                return "S";
                break;

            case (2):
                return "SU";
                break;

            case (3):
                return "E";
                break;

            case (4):
                return "M";
                break;

            case (5):
                return "A";
                break;
            case (6):
                return "ST";
                break;
        }
    }
    public function getLevelTypeAttribute()
    {

        switch ($this->type) {



            case (1):
                return 1;
                break;

            case (2):

                return 2;
                break;

            case (3):
                return 4;
                break;

            case (4):
                return 4;
                break;

            case (5):
                return 3;
                break;
            case (6):
                return 6;
                break;
            case (0):
                return 4;
                break;
        }
    }
    public function agentBankDetail()
    {
        return $this->hasOne(AgentBankDetail::class);
    }
    public function passwordSecurity()
    {
        return $this->hasOne(PasswordSecurity::class);
    }
    public function playmates()
    {
        return $this->belongsToMany(Escort::class, 'playmates', 'user_id', 'playmate_id');
    }
    public function getPlaymatesAttribute()
    {
        $this->loadMissing('listedEscorts.playmates');
        return $this->escorts
            ->flatMap(fn($escort) => $escort->playmates)
            ->unique('id')
            ->sortBy('name')
            ->values();
    }
    public function getAddedByAttribute()
    {
        $this->loadMissing('listedEscorts.addedBy');
        return $this->escorts
            ->flatMap(fn($escort) => $escort->addedBy)
            ->unique('id')
            ->sortBy('name')
            ->values();
    }
    public function scopeInRole($q, $role)
    {
        $type = $this->findRole($role);

        return $q->where('type', $type);
    }

    public function scopeEnabled(Type $var = null)
    {
        # code...
    }

    public function getHomeStateAttribute()
    {
        return $this->state->iso2;
        //return strtoupper(substr(config('escorts.profile.statesName')[$this->state->name],0,2));
    }
    public function ContactType($val)
    {
        $arr = [];
        $arrs = [];

        if (isset($val)) {
            // if(in_array( 1, $val)){
            //     $arr += ["Message"];
            // }
            // if(in_array( 2, $val)){
            //     $arr += ["Text"];
            // }
            $i = 1;
            foreach ($val as $number) {
                $arrs[] += $i;
                //echo "</br>i=".$i;
                if ($number == 1) {
                    $arr[] = "Message";
                }
                if ($number == 2) {
                    $arr[] = "Text";
                }
                if ($number == 3) {
                    $arr[] = "Email";
                }
                if ($number == 4) {
                    $arr[] = "Call me";
                }
                $i++;
            }
        }
        // dd($arr);
        // dd($arrs);
        return $arr;
    }
    public function getContactTypeAttribute22(array $val)
    {
        $arr = [];
        foreach ($val as $number) {
            switch ($number) {



                case (1):
                    $arr += "Message";
                    break;

                case (2):

                    $arr += "Text";
                    break;

                case (3):
                    $arr += "Email";
                    break;

                case (4):
                    $arr += "Call me";
                    break;
            }
        }




        //dd($arr);
        return $arr;
    }
    public function setMemberIdAttribute($value)
    {
        // If value is provided, use it, otherwise generate based on type and state
        if (empty($value)) {
            $memberId = $this->generateMemberId();
            $this->attributes['member_id'] = $memberId;
        } else {
            $this->attributes['member_id'] = $value;
        }
    }

    public function generateMemberId()
    {
        if ($this->type == 1) {
           // return 'S' . config('escorts.profile.statesName')[$this->state->name] . sprintf("%04d", $this->id);
            $staffPrefix = config('staff.staff_member_id_prefix');
            //$memberId = $staffPrefix . $this->city_id . sprintf("%04d", $this->id);
            $staff = User::select(['id', 'name', 'member_id'])
                ->where('type', '1')
                ->where('member_id', '!=', '')
                ->where('member_id', '!=', 'S60001')
                ->orderByDesc('id')
                ->first();
            if ($staff && !empty($staff->member_id)) {
                $code = trim($staff->member_id);
                $prefix = 'S';
                preg_match('/\d+$/', $code, $numberMatch);
                $number = isset($numberMatch[0]) ? (int)$numberMatch[0] : 0;
                $length = strlen($numberMatch[0] ?? '00002');
                // Increment and pad
                $newCode = $prefix . str_pad($number + 1, $length, '0', STR_PAD_LEFT);
                $memberId = $newCode;
            } else {
                $memberId = 'S60002';
            }
            return $memberId;
        }
        if ($this->type == 2) {
            return 'SU' . config('escorts.profile.statesName')[$this->state->name] . sprintf("%04d", $this->id);
        }
        if ($this->type == 0) {
            return 'V' . config('escorts.profile.statesName')[$this->state->name] . sprintf("%04d", $this->id);
        }
        if ($this->type == 3) {
            return 'E' . config('escorts.profile.statesName')[$this->state->name] . sprintf("%04d", $this->id);
        }
        if ($this->type == 5) {
            return 'A' . config('escorts.profile.statesName')[$this->state->name] . sprintf("%04d", $this->id);
        }
        if ($this->type == 4) {
            return 'M' . config('escorts.profile.statesName')[$this->state->name] . sprintf("%04d", $this->id) . ':001';
        }
        if ($this->type == 9) {
            return 'UP' . config('escorts.profile.statesName')[$this->state->name] . sprintf("%04d", $this->id) . ':001';
        }
        if ($this->type == 10) {
            return 'DL' . config('escorts.profile.statesName')[$this->state->name] . sprintf("%04d", $this->id) . ':001';
        }
        if ($this->type == 6) {
            $staffPrefix = config('staff.staff_member_id_prefix');
            $memberId = $staffPrefix . $this->city_id . sprintf("%04d", $this->id);
            $staff = User::select(['id', 'name', 'member_id'])
                ->where('type', '6')
                ->where('member_id', '!=', '')
                ->where('member_id', '!=', 'S60001')
                ->orderByDesc('id')
                ->first();
            if ($staff && !empty($staff->member_id)) {
                $code = trim($staff->member_id);
                $prefix = 'S';
                preg_match('/\d+$/', $code, $numberMatch);
                $number = isset($numberMatch[0]) ? (int)$numberMatch[0] : 0;
                $length = strlen($numberMatch[0] ?? '00002');
                // Increment and pad
                $newCode = $prefix . str_pad($number + 1, $length, '0', STR_PAD_LEFT);
                $memberId = $newCode;
            } else {
                $memberId = 'S60002';
            }

            return $memberId;
        }

        return null;
    }

    public function getMemberIdAttribute()
    {
        // Return the stored member_id from database
        return $this->attributes['member_id'] ?? null;
    }

    /**
     * Boot method to automatically set member_id when user is created
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            // Only set member_id if it's not already set
            if (empty($user->member_id)) {
                if ($user->generateMemberId()) {
                    $user->member_id = $user->generateMemberId();
                    $user->save();
                }
            }
        });
    }

    public function escorts()
    {
        return $this->hasMany('App\Models\Escort', 'user_id');
    }

    public function listedEscorts()
    {
        return $this->hasMany('App\Models\Escort', 'user_id')
            ->whereNotNull('name')
            ->where('enabled', 1);
    }

    public function interest()
    {
        return $this->hasOne(ViewerInterest::class, 'user_id');
    }

    public function escortViewerInteraction()
    {
        return $this->hasOne(EscortViewerInteractions::class, 'viewer_id', 'id');
    }
    // public function massageProfiles()
    // {
    //     return $this->hasMany('App\Models\MassageProfile', 'user_id');
    // }


    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id');
    }

    public function state()
    {
        return $this->belongsTo('App\Models\State', 'state_id');
    }

    public function currentState()
    {
        return $this->belongsTo('App\Models\State', 'current_state_id');
    }

    public function pages()
    {
        return $this->hasMany('App\Models\Page', 'user_id');
    }

    public function agentEscorts()
    {
        return $this->belongsToMany('App\Models\User', 'agent_escorts', 'agent_id', 'escort_id')->where('type', 3)->where('enabled', 1);
    }
    public function escortsAgents()
    {
        return $this->belongsToMany('App\Models\User', 'agent_escorts', 'escort_id', 'agent_id')->where('type', 5)->where('enabled', 1);
    }
    public function myLegBox()
    {
        return $this->belongsToMany(Escort::class, 'my_legbox', 'user_id', 'escort_id');
    }
    public function massageCenterLegBox()
    {
        return $this->belongsToMany(MassageProfile::class, 'massage_legbox', 'user_id', 'massage_id');
    }
    public function getEscortsAgentAttribute()
    {
        if ($agent = $this->escortsAgents) {
            return $agent->first();
        }
        return false;
    }




    public function my_agent()
    {
        return $this->belongsTo(User::class, 'assigned_agent_id', 'id');
    }

    public function referByMassageCenter()
    {
        return $this->hasMany(User::class, 'assigned_agent_id');
    }

    public function referByAgent()
    {
        return $this->hasMany(User::class, 'referred_by_agent_id');
    }

    public function defaultPinupImage()
    {
        return $this->hasOne(EscortMedia::class)
            ->where(['default' => 1, 'position' => 10]);
    }

    public function shortList()
    {
        return $this->belongsToMany(Escort::class, 'add_to_list', 'user_id', 'escort_id');
    }


    // public function getAvatarImgAttribute($value)
    // {
    //     if ($value != "")
    //         return $value;

    //     switch ($this->type) {
    //         case 3: //for escort
    //             return config('constants.escort_default_icon');
    //         case 4: // fro massage center
    //             return config('constants.massage_escort_default_icon');
    //         case 5: //for agent
    //             return config('constants.agent_default_icon');
    //         case 0: // For Viewers
    //             return config('constants.viewer_default_icon');
    //         default:
    //             return $value;
    //     }
    // }

    /**
     * Check if user has uploaded avatar (not default)
     */
    public function hasUploadedAvatar()
    {
        return !empty($this->attributes['avatar_img']);
    }



    /**
     * Get avatar URL (uploaded or default)
     */
    public function getAvatarUrlAttribute($value)
    {
        if ($this->hasUploadedAvatar()) {
            return asset('avatars/' . $this->avatar_img);
        }

        // Return default image based on user type
        switch ($this->type) {
            case 3: //for escort
                return config('constants.escort_default_icon');
            case 4: // fro massage center
                return config('constants.massage_default_icon');
            case 5: //for agent
                return config('constants.agent_default_icon');
            case 6: //for Staff
                return config('constants.agent_default_icon');
            case 0: // For Viewers
                return config('constants.viewer_default_icon');
            default:
                return $value;
        }
    }


    public function agent_detail()
    {
        return $this->belongsTo(AgentDetail::class,  'id', 'agent_id');
    }

    public function loginAttempts()
    {
        return $this->hasOne(LoginAttempt::class,  'user_id', 'id')->where('online', 'yes')->orderBy('id', 'desc');
    }

    public function LoginStatus()
    {
        return $this->hasOne(LoginAttempt::class,  'user_id', 'id');
    }

    public function account_setting()
    {
        return $this->belongsTo(AccountSetting::class, 'id', 'user_id');
    }

    public function viewer_settings()
    {
        return $this->belongsTo(ViewerSetting::class, 'id', 'user_id');
    }


    public function agent_settings()
    {
        return $this->belongsTo(AgentSetting::class, 'id', 'user_id');
    }

    public function massage_settings()
    {
        return $this->belongsTo(MassageSetting::class, 'id', 'user_id');
    }

    public function escort_settings()
    {
        return $this->belongsTo(EscortSetting::class, 'id', 'user_id');
    }

    

    

    public function staff_detail()
    {
        return $this->belongsTo(StaffDetail::class,  'id', 'user_id');
    }

    public function generateOTP()
    {
        $otp = '123456';
        //$otp = mt_rand(1000,9999);
        return $otp;
    }


    public function update_last_login($user)
    {
        try {
            $accountSetting = new AccountSetting;
            $accountSetting = AccountSetting::where('user_id', $user->id)->first();
            if (!$accountSetting) {
                AccountSetting::create([
                    'user_id'  => $user->id,
                    'password_updated_date' => date('Y-m-d H:i:s'),
                    'password_expiry_days'   => '30',
                    'is_text_notificaion_on' => '0',
                    'is_email_notificaion_on' => '0',
                    'is_first_login' => '0',
                    'last_login' =>  date('Y-m-d H:i:s')
                ]);
            } else {
                $accountSetting->last_login = date('Y-m-d H:i:s');
                $accountSetting->save();
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function referrals()
    {
        return $this->hasMany(User::class, 'assigned_agent_id');
    }
}
