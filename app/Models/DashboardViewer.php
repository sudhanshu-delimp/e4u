<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DashboardViewer extends Model
{
    use HasFactory;

     protected $casts = [
        'my_view' => 'array',
    ];

    protected $fillable = ['user_id', 'my_view'];
}
