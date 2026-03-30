<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MassageCenterTerritory;
class MassageExcel extends Model
{
    use HasFactory;

    protected $table = 'massage_excels';
    public $timestamps = true;


    protected $fillable = ['id', 'bussiness_name', 'address', 'post_code','territory_name', 'state_abbr', 'state_id', 'mobile_number', 'business_number', 'email', 'website'];

    public function territory()
    {
        return $this->belongsTo(MassageCenterTerritory::class, 'territory_name', 'territory_name');
    }
}
