<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MassageCenterTerritory extends Model
{
    use HasFactory;

    protected $table = 'massage_center_territories';

    protected $fillable = ['id', 'territory_name', 'status'];

    public function centres()
    {
        return $this->hasMany(MassageExcel::class, 'territory_name', 'territory_name');
    }
}
