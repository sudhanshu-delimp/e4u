<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Punterbox extends Model
{
    use HasFactory;

    protected $table = 'punterbox';

    protected $fillable = [
        'user_id',
        'incident_date',
        'incident_state',
        'incident_location',
        'escorts_name',
        'escorts_mobile',
        'escorts_email',
        'incident_nature',
        'platform',
        'profile_link',
        'what_happened',
        'rating',
        'status',
        'admin_action',
        'admin_id',
    ];

    protected $casts = [
        'incident_date' => 'date',
    ];

    const STATUS_PENDING  = 'Pending';
    const STATUS_APPROVED = 'Approved';
    const STATUS_REJECTED = 'Rejected';

    const INCIDENT_NATURE_FRAUD    = 'Fraud';
    const INCIDENT_NATURE_NO_SHOW  = 'No Show';
    const INCIDENT_NATURE_VIOLENCE = 'Violence';

    const RATING_DO_NOT_BOOK      = 'Do not book';
    const RATING_EXERCISE_CAUTION = 'Exercise caution';
    const RATING_SAFE             = 'Safe';

    public static function incidentNatureOptions(): array
    {
        return [
            self::INCIDENT_NATURE_FRAUD,
            self::INCIDENT_NATURE_NO_SHOW,
            self::INCIDENT_NATURE_VIOLENCE,
        ];
    }

    public static function ratingOptions(): array
    {
        return [
            self::RATING_DO_NOT_BOOK,
            self::RATING_EXERCISE_CAUTION,
            self::RATING_SAFE,
        ];
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'incident_state');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}