<?php

namespace App\Models;

use App\Models\MassageProfile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MassageReviews extends Model
{

     use HasFactory;
    protected $guarded =['id'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function massageprofile()
    {
        return $this->hasOne(MassageProfile::class, 'id', 'massage_id');
    }
}
