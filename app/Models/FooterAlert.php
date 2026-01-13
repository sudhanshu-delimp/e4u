<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterAlert extends Model
{
    use HasFactory;
    protected $table = 'footer_alerts';
    protected $fillable = ['alert_type', 'subject', 'description', 'message', 'status'];
}
