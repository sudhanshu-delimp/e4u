<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PlaymateHistory extends Model
{
    use HasFactory;
    protected $table = 'playmate_history';
    protected $fillable = [
        'escort_id',
        'playmate_id',
        'user_id',
    ];

    /**
     * Escort who owns this playmate
     */
    public function escort()
    {
        return $this->belongsTo(Escort::class, 'escort_id');
    }

     /**
     * Playmate escort
     */
    public function playmate()
    {
        return $this->belongsTo(Escort::class, 'playmate_id');
    }

    /**
     * Who added this to history
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getStatusAttribute()
    {
        return DB::table('escort_playmate')
            ->where('escort_id', $this->escort_id)
            ->where('playmate_id', $this->playmate_id)
            ->exists() 
            ? 'active' 
            : 'inactive';
    }

    public function getGroupStatusAttribute()
    {
        $listedProfiles = $this->user->listedEscorts()->pluck('id');
        return DB::table('escort_playmate')
            ->where('playmate_id', $this->playmate_id)
            ->whereIn('escort_id',$listedProfiles)
            ->exists()?'active':
            'inactive';
    }
}
