<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EscortBankDetail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = "escort_bank_details";


    public function getAccountNumberAttribute($value)
    {
        return formatMobileNumber($value);
    }

    public function setAccountNumberAttribute($value)
    {

        $clean = removeSpaceFromString($value);
        $this->attributes['account_number'] = $clean;
    }
}
