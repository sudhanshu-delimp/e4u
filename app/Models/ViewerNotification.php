<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewerNotification extends Model
{
    use HasFactory;
    
  protected $table = "viewer_notifications";
    protected $fillable = [
        'current_day','heading', 'type', 'start_date', 'end_date', 'member_id', 'recurring_type', 'start_day', 'end_day', 'start_month', 'end_month', 'num_recurring', 'content', 'scheduled_days', 'status'
    ];

}
