<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Escort;

class Playmate extends Model
{
	protected $guarded = ['id'];
	
	public function escorts()
	{
		return $this->belongsTo(Escort::class, 'playmate_id');
		//return $this->belongsToMany(Playmate::class, 'escorts', 'playmate_id','escort_id');
		//return $this->belongsToMany(Escort::class, 'playmates', 'playmate_id', 'escort_id');
	}

	public function users()
	{
		return $this->belongsTo(User::class, 'user_id');
		//return $this->belongsToMany(Playmate::class, 'escorts', 'playmate_id','escort_id');
		//return $this->belongsToMany(Escort::class, 'playmates', 'playmate_id', 'escort_id');
	}

}
