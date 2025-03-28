<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MassageService extends Model
{
    protected $table = "massage_services";
    protected $guarded = ['id'];
    // protected $casts = [
    //     'availability_time' => 'array',
    // ];

    public function massage_services()
    {
        return $this->hasMany('App\Models\MassageProfile','massage_profile_id');
    }

}
