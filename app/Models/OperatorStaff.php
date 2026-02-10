<?php

namespace App\Models;

use App\Models\OperatorStaffDetail;
use App\Models\User;
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

    public function operator()
    {
        return $this->belongsTo(User::class, 'operator_id', 'id');
    }
    
     public function operator_staff_setting()
    {
        return $this->hasOne('App\Models\OperatorStaffSetting', 'user_id');
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

    public function getBusinessNumberAttribute($value)
    {
      return formatMobileNumber($value);
    }

    public function setBusinessNumberAttribute($value)
    {
        $clean = removeSpaceFromString($value);
        $this->attributes['business_number'] = $clean;
    }

}
