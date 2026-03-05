<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaVerification extends Model
{
    protected $fillable = [
        'user_id',
        'image_path',
        'type',
        'status',
        'comment',
        'reviewed_by',
        'reviewed_at'
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
       'status' => 'string',
    ];

   
    const STATUS_PENDING  = '0';
    const STATUS_APPROVED = '1';
    const STATUS_REJECTED = '2';

    public function getStatusAttribute($value)
    {
        switch ($value) {
            case self::STATUS_APPROVED:
                return 'Verified';
            case self::STATUS_REJECTED:
                return 'Rejected';
            default:
                return 'Pending';
        }
    }


    public function getRawStatusAttribute()
    {
        return $this->attributes['status'];
    }

    public function setStatusAttribute($value)
    {
        if ($value === 'Verified') {
            $this->attributes['status'] = self::STATUS_APPROVED;
        } elseif ($value === 'Rejected') {
            $this->attributes['status'] = self::STATUS_REJECTED;
        } else {
            $this->attributes['status'] = self::STATUS_PENDING;
        }
    }

     // Jis user ne verification upload kiya
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Jis admin ne review kiya
    // public function reviewer()
    // {
    //     return $this->belongsTo(User::class, 'reviewed_by');
    // }

}