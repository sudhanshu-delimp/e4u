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
        switch ($value) {
            case (1):
                return 'Level 1';
                break;
            case (2):
                return 'Level 2';
                break;
            case (3):
                return 'Level 3';
                break;
            case (4):
                return 'Level 4';
                break;
            default:
                return 'N/A';
        }
    }
}
