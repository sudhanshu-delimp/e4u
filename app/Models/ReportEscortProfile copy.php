<?php

namespace App\Models;

use App\Models\MassageProfile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportEscortProfile extends Model
{
    use HasFactory;

    protected $table = 'report_escort_profiles';
    
    protected $fillable = ['id', 'advertiser_id', 'advertiser_type', 'viewer_id', 'report_tag', 'report_desc', 'admin_id', 'report_status', 'action_message'];

    

    public function viewer()
    {
        return $this->hasOne(User::class, 'id', 'viewer_id');
    }


     public function escort()
    {
       return $this->belongsTo(Escort::class, 'advertiser_id');
    }

    public function massage()
    {
         return $this->belongsTo(MassageProfile::class, 'advertiser_id');
    }

     public function getAdvertiserAttribute()
    {
        if ($this->advertiser_type == 'escort') {
            return $this->escort;
        }

        if ($this->advertiser_type == 'massage') {
            return $this->massage;
        }

        return null;
    }

}
