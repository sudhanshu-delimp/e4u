<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewerInterest extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','features', 'notifications', 'interests','city'];

}
