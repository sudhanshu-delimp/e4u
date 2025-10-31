<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariablLoyaltyProgram extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
     protected $fillable = [
        'type', 'level', 'discription', 'amount', 'reward'
    ];
}
