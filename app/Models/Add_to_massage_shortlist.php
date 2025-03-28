<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Add_to_massage_shortlist extends Model
{
    use HasFactory;
    protected $table = "add_to_massage_sort_list";
    protected $guarded = ['id'];
}
