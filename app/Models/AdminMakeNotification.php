<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminMakeNotification extends Model
{
    use HasFactory;
     protected $fillable = [
        'ref', 'heading', 'start_date', 'finish_date',
        'type', 'content', 'status', 'member_id'
    ];
}
