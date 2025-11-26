<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Request;

class Num extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'incident_date',
        'incident_state',
        'incident_location',
        'offender_name',
        'offender_mobile',
        'offender_email',
        'incident_nature',
        'platform',
        'profile_link',
        'what_happened',
        'rating',
        'status',
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'incident_state');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // public function setStatusAttribute($value)
    // {
    //     $this->attributes['status'] = $this->normalizeValue($value);
    // }

    // public function setRatingAttribute($value)
    // {
    //     $this->attributes['rating'] = $this->normalizeValue($value);
    // }

    // public function setIncidentNatureAttribute($value)
    // {
    //     $this->attributes['incident_nature'] = $this->normalizeValue($value);
    // }

    // public function getStatusAttribute($value)
    // {
    //     return $this->formatLabel($value);
    // }

    // public function getRatingAttribute($value)
    // {
    //     return $this->formatLabel($value);
    // }

    // public function getIncidentNatureAttribute($value)
    // {
    //     return $this->formatLabel($value);
    // }

    // private function normalizeValue($value)
    // {
    //     if (empty($value)) return $value;

    //     // convert to lowercase
    //     $value = strtolower($value);

    //     // replace spaces with underscores
    //     $value = str_replace(' ', '_', $value);

    //     return $value;
    // }

    // private function formatLabel($value)
    // {
    //     if (empty($value)) {
    //         return $value;
    //     }

    //     // Replace underscores with spaces (if any)
    //     $value = str_replace('_', ' ', $value);

    //     // Convert to Title Case
    //     return Str::title(strtolower($value));
    // }
}
