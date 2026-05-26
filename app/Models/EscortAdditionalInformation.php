<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EscortAdditionalInformation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'type', 'value', 'short_desc'];

    const TYPES = [
        'address', 
        'title',
        'narration',
    ];
}
