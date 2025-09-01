<?php

namespace App\Models;

use App\Models\AgentDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agent extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = "users";

    public function agent_detail()
    {
      return $this->belongsTo(AgentDetail::class,  'id','agent_id');  
    }

}
