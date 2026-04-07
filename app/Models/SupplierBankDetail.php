<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierBankDetail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = "supplier_bank_details";
}
