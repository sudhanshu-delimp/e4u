<?php

namespace App\Models;

use App\Models\StaffDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Staff extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = "users";

    public function staff_detail()
    {
      return $this->belongsTo(AgentDetail::class,  'id','user_id');  
    }

}
