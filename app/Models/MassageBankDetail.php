<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MassageBankDetail extends Model
{
    use HasFactory;
    protected $table = "massage_center_bank_details";
    protected $guarded = ['id'];
}
