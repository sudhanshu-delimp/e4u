<?php

namespace App\Models;

use App\Models\Masseur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MassagerMasseur extends Model
{
    use HasFactory;

     public function masseur()
    {
        return $this->hasOne(Masseur::class,  'id','masseur_profile_id');
    }
}
