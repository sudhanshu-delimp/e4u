<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MassageBumpup extends Model
{
    use HasFactory;
    protected $table = "massage_bumpup";
    protected $guarded = ['id'];
}
