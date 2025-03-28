<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EscortLike extends Model
{
    use HasFactory;
    protected $table = "escort_likes";
    protected $guarded = ['id'];
}
