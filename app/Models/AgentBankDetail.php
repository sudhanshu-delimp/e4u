<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentBankDetail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = "agent_bank_details";

    public function getAccountNumberAttribute($value)
    {
        return formatMobileNumber($value);
    }

    public function setAccountNumberAttribute($value)
    {
        $clean = removeSpaceFromString($value);
        $this->attributes['account_number'] = $clean;
    }

    public function getBsbAttribute($value)
    {
        return formatMobileNumber($value);
    }

    public function setBsbAttribute($value)
    {
        $clean = removeSpaceFromString($value);
        $this->attributes['bsb'] = $clean;
    }
}
