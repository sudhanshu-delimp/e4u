<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MassageExcel extends Model
{
    use HasFactory;

    protected $table = 'massage_excels';

    protected $fillable = ['id', 'bussiness_name', 'address', 'post_code', 'state_abbr', 'state_id', 'mobile_number', 'business_number', 'email', 'website'];
}
