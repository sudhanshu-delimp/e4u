<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Feedback;

class Option extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
     protected $hidden = ['created_at', 'updated_at'];


    public function feedbacks()
    {
        return $this->hasOne(Feedback::class, 'option_id', 'id');
    }

}

