<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordSecurity extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = ['password_notification'=> 'array'];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
