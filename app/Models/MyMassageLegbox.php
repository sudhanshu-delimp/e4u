<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyMassageLegbox extends Model
{
    use HasFactory;
    protected $table = "massage_legbox";
    protected $guarded = ['id'];
}
