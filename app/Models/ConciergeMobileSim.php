<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConciergeMobileSim extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $fillable = [
        'user_id',
        'contact_pref_email',
        'contact_pref_mobile',
        'first_name',
        'last_name',
        'email',
        'mobile',
        'delivery_address',
        'comments',
        'terms',
        'status',
        'period_required'
    ];
}
