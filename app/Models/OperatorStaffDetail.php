<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Model;

class OperatorStaffDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'address',
        'kin_name',
        'kin_relationship',
        'kin_mobile',
        'kin_email',
        'position',
        'location',
        'commenced_date',
        'security_level',
        'employment_status',
        'employment_agreement',
        'building_access_code',
        'keys_issued',
        'car_parking',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
    ];
    protected $hidden = ['updated_at'];

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

    public function scopeSecurityLevel($query, $value)
    {
        switch ($value) {
            case (1):
                return 'Level 1';
                break;
            case (2):
                return 'Level 2';
                break;
            default:
                return 'N/A';
        }
    }

    public function scopePosition($query, $value)
    {
        switch ((int)$value) {
            case (1):
                return 'Admin';
                break;
            case (2):
                return 'Staff';
                break;
           
            default:
                return 'N/A';
        }
    }

    public function getKinMobileAttribute($value)
    {
      return formatMobileNumber($value);
    }

    public function setKinMobileAttribute($value)
    {
    
        $clean = removeSpaceFromString($value);
        $this->attributes['kin_mobile'] = $clean;
    }
}
