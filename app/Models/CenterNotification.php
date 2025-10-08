<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CenterNotification extends Model
{
    use HasFactory;

    protected $table = 'center_notifications';

    protected $fillable = [
        'heading', 'start_date', 'finish_date', 'type', 'content','template_name', 'member_id', 'status'
    ];
}
