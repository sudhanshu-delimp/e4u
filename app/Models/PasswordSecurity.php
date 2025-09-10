<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PasswordSecurity extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = ['password_notification'=> 'array'];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
