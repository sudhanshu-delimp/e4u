<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = "tasks";
    protected $guarded = ['id'];
    protected $fillable = [
        'title', 'priority', 'status', 'description', 'user_id'
    ];
}
