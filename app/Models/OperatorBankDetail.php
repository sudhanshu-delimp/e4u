<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperatorBankDetail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = "operator_bank_details";
}
