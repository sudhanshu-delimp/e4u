<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertiserAgentRequestUser extends Model
{
    use HasFactory;
    protected $table = "advertiser_agent_request_users";
    protected $guarded = ['id'];
    protected $fillable = [
        'advertiser_agent_requests_id',
        'advertiser_user_id',
        'receiver_agent_id',
        'status',
    
    ];


    public function user()
    {
        return $this->belongsTo(User::class,'receiver_agent_id','id');
        
    }
    public function receiverAgent()
    {
        return $this->belongsTo(User::class, 'receiver_agent_id');
    }

}
