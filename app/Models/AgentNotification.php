<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'heading', 'content', 'type', 'start_date', 'end_date', 'active_from', 'active_to', 'duration_unit', 'member_id', 'status'
    ];
}
