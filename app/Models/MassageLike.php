<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MassageLike extends Model
{
    use HasFactory;
    protected $table = "massage_likes";
    protected $guarded = ['id'];
}
