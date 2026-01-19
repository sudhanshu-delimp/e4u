<?php

namespace App\Models;

use App\Models\OperatorDetail;
use App\Models\OperatorSetting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Operator extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = "users";

    protected $casts = [
        'contact_type' => 'array',
    ];

    public function operator_detail()
    {
      return $this->belongsTo(OperatorDetail::class,  'id','user_id');  
    }
    public function operator_setting()
    {
        return $this->belongsTo(OperatorSetting::class, 'id', 'user_id');
    }
    
     public function setting()
    {
        return $this->hasOne('App\Models\OperatorSetting', 'staff_id');
    }

    public function getPhoneAttribute($value)
    {
      return formatMobileNumber($value);
    }

    public function setPhoneAttribute($value)
    {
        $clean = removeSpaceFromString($value);
        $this->attributes['phone'] = $clean;
    }

    public function getBusinessNumberAttribute($value)
    {
      return formatMobileNumber($value);
    }

    public function setBusinessNumberAttribute($value)
    {
        $clean = removeSpaceFromString($value);
        $this->attributes['business_number'] = $clean;
    }

    protected static function boot()
    {
          parent::boot();
          static::created(function ($operator) {
              \App\Models\OperatorSetting::create([
                  'user_id' => $operator->id, // operator_detail.id
                  'idle_preference_time' => '30',
                  'twofa' => '2',
              ]);
          });
    }
}
