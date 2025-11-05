<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffDetail extends Model
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
    ];
    protected $hidden = ['updated_at'];

    public function scopeSecurityLevel($query, $value)
    {
 
        return match ($value) {
            1 => 'Level 1',
            2 => 'Level 2',
            3 => 'Level 3',
            4 => 'Level 4',
            default =>'N/A'
        };
    }
}
