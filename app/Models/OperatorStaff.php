<?php

namespace App\Models;

use App\Models\OperatorStaffDetail;
//use Illuminate\Database\Eloquent\Model;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OperatorStaff extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = "users";

    public function operator_staff_detail()
    {
      return $this->belongsTo(OperatorStaffDetail::class,  'id','user_id');  
    }
    
     public function operator_staff_setting()
    {
        return $this->hasOne('App\Models\OperatorStaffSetting', 'staff_id');
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

    public function getPhoneAttribute($value)
    {
      return formatMobileNumber($value);
    }

    public function setPhoneAttribute($value)
    {
    
        $clean = removeSpaceFromString($value);
        $this->attributes['phone'] = $clean;
    }


    /* protected static function boot()
    {
          parent::boot();

          static::created(function ($staff) {
              \App\Models\OperatorStaffSetting::create([
                  'staff_id' => $staff->id, // staff_detail.id
                  'idle_preference_time' => '30',
                  'twofa' => '2',
              ]);
          });
    } */

}
