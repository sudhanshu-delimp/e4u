<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShareholderNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'current_day',
        'heading',
        'type',
        'start_date',
        'end_date',
        'member_id',
        'recurring_type',
        'start_day',
        'end_day',
        'start_month',
        'end_month',
        'num_recurring',
        'content',
        'scheduled_days',
        'status',
        'template_name'
    ];
}
