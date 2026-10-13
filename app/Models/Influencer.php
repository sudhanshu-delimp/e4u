<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use App\Models\Model;

class Influencer extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'email',
        'social_media',
        'comments',
        'status',
        'ref_number'
    ];

}
