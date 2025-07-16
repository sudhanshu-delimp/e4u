<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentRequest extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = [
        'user_id',
        'contact_by_email',
        'contact_by_mobile',
        'first_name',
        'last_name',
        'email',
        'mobile_number',
        'status',
        'ref_number',
        'comments'
    ];

     public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    
}
