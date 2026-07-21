<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MassageBankDetail extends Model
{
    use HasFactory;
    protected $table = "massage_center_bank_details";
    protected $guarded = ['id'];


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
