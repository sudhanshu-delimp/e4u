<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShareholderContact extends Model
{
    use HasFactory;
    protected $table = 'shareholder_contact';

    protected $fillable = [
        'user_id',
        'name',
        'mobile',
        'email',
        'position',
    ];

    public function getMobileAttribute($value)
    {
        return formatMobileNumber($value);
    }

    public function setMobileAttribute($value)
    {
        $clean = removeSpaceFromString($value);
        $this->attributes['mobile'] = $clean;
    }

    public static function getEmails($userId = 0)
    {
        $emails = self::where('user_id', $userId)
            ->whereNotNull('email')
            ->where('email', '!=', '')
            ->pluck('email');
        return $emails->toArray();
    }
}
