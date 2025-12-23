<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalNotification extends Model
{
    use HasFactory;
    protected $table = 'global_notifications';
    protected $fillable = [
        'heading', 'start_date', 'end_date', 'type', 'content','template_name', 'member_id', 'status'
    ];
}
