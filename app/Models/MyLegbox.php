<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyLegbox extends Model
{
    use HasFactory;
    protected $table = "my_legbox";
    protected $guarded = ['id'];

    public function viewer_user()
    {
        return $this->belongsTo('App\Models\User', 'viewer_user_id');
    }
}
