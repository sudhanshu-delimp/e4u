<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasseurRate extends Model
{
    use HasFactory;
    protected $table = "masseur_rate";
    protected $guarded = ['id'];

    
}
