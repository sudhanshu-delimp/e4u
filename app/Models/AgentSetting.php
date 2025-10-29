<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentSetting extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

     protected $fillable = [
        
    'user_id',
    'direct_chatting_with_advertisers',
    'advertiser_email', 
    'advertiser_text',
    
    'escort_email',
    'escort_text',
   
    'twofa',
    'call',
    'idle_preference_time',

];
  
}
