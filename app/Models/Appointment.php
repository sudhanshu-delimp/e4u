<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'advertiser_id',
        'date',
        'time',
        'address',
        'lat',
        'long',
        'source',
        'importance',
        'agent_id',
        'status',
        'summary',
    ];


    public function advertiser() {
        return $this->belongsTo(User::class, 'advertiser_id', 'id');
    }
}
