<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegboxNotificationForEscrt extends Model
{
    use HasFactory;
    protected $table = 'legbox_notification_for_escrts';
    protected $fillable = [
        'heading',
        'start_date',
        'end_date',
        'type',
        'content',
        'template_name',
        'member_id',
        'status',
        'create_by',
        'create_by_member_id',
    ];
}
