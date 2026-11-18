<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailHostingRequest extends Model
{
    use HasFactory;
    protected $table = 'email_hosting_requests';
protected $fillable = [
    'user_id',
    'email',
    'first_name',
    'last_name',
    'mobile',
    'contact_pref',
    'contact_preference',
    'term_condition',
    'auth',
    'period_required',
    'comments',
];

protected $casts = [
    'contact_pref' => 'array',
    'contact_preference' => 'array',
    'term_condition' => 'boolean',
    'auth' => 'boolean',
];
}
