<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EscortBrb extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "escort_brb";
    protected $guarded = ['id'];

    public function escort()
    {
        return $this->belongsTo(Escort::class, 'profile_id');
    }
}
