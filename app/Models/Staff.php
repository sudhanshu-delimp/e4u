<?php

namespace App\Models;

use App\Models\StaffDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Staff extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = "users";

    public function staff_detail()
    {
      return $this->belongsTo(StaffDetail::class,  'id','user_id');  
    }
    
     public function setting()
    {
        return $this->hasOne('App\Models\StaffSetting', 'staff_id');
    }

    protected static function boot()
    {
          parent::boot();

          static::created(function ($staff) {
              \App\Models\StaffSetting::create([
                  'staff_id' => $staff->id, // staff_detail.id
                  'idle_preference_time' => '30',
                  'twofa' => '2',
              ]);
          });
    }
}
