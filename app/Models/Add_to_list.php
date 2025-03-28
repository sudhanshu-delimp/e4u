<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Add_to_list extends Model
{
    use HasFactory;
    protected $table = "add_to_list";
    protected $guarded = ['id'];
}
