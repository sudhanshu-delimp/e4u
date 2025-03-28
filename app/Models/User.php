<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\PasswordSecurity;
use App\Models\AgentBankDetail;

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

    public function getOnlineAttribute()
    {
        if(!$this->last_online_at) return false;

        if($this->last_online_at->diffInMinutes(now()) < 2 ) {
            return true;
        }
        return false;
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
    {     $arr = [];
        $arrs = [];

        if(isset($val)) {
            // if(in_array( 1, $val)){
            //     $arr += ["Message"];
            // }
            // if(in_array( 2, $val)){
            //     $arr += ["Text"];
            // }
            $i = 1;
            foreach($val as $number)
            {
                $arrs[] += $i;
                //echo "</br>i=".$i;
                if ($number == 1){
                    $arr[] = "Message";

                }
                if ($number == 2){
                    $arr[] = "Text";
                }
                if ($number == 3){
                    $arr[] = "Email";
                }
                if ($number == 4){
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
        foreach($val as $number)
        {
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
    public function getMemberIdAttribute()
    {
        //dd($this->state);
        // return 'E4U20'.$this->id;
        if($this->type == 1) {
            return 'S'.config('escorts.profile.statesName')[$this->state->name].sprintf("%04d",$this->id);
        }
        if($this->type == 2) {
            return 'SU'.config('escorts.profile.statesName')[$this->state->name].sprintf("%04d",$this->id);
        }
        if($this->type == 0) {
            return 'V'.config('escorts.profile.statesName')[$this->state->name].sprintf("%04d",$this->id);
        }
        if($this->type == 3) {
            return 'E'.config('escorts.profile.statesName')[$this->state->name].sprintf("%04d",$this->id);
        }
        if($this->type == 5) {
            return 'A'.config('escorts.profile.statesName')[$this->state->name].sprintf("%04d",$this->id);
        }
        if($this->type == 4) {
            return 'M'.config('escorts.profile.statesName')[$this->state->name].sprintf("%04d",$this->id).':001';
        }


    }

    public function escorts()
    {
        return $this->hasMany('App\Models\Escort', 'user_id');
    }
    // public function massageProfiles()
    // {
    //     return $this->hasMany('App\Models\MassageProfile', 'user_id');
    // }


    public function city()
    {
        return $this->belongsTo('App\Models\City','city_id');
    }

    public function state()
    {
        return $this->belongsTo('App\Models\State','state_id');
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
        return $this->belongsToMany('App\Models\User', 'agent_escorts', 'escort_id','agent_id')->where('type', 5)->where('enabled', 1);
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
        if($agent = $this->escortsAgents) {
            return $agent->first();
        }
        return false;
    }

    public function shortList()
    {
        return $this->belongsToMany(Escort::class, 'add_to_list', 'user_id', 'escort_id');
    }

}
