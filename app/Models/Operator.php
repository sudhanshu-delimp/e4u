<?php

namespace App\Models;

use App\Models\OperatorDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Operator extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = "users";

    public function operator_detail()
    {
      return $this->belongsTo(OperatorDetail::class,  'id','user_id');  
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
