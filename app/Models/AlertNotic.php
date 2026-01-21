<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlertNotic extends Model
{
    use HasFactory;
    protected $table = 'alert_notics';
    protected $fillable = ['id', 'motion','notice_descrioption', 'action'];
}
