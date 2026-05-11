<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Support\Facades\Auth;
use App\Models\Model;

class Shareholding extends Model
{
    use HasFactory;

    protected $table = 'shareholding';

    protected $fillable = [
        'user_id',
        'member_id',
        'date_of_entry',
        'member_type',
        'threshold',
        'number_of_shares',
        'shareholding',
        'held_on_trust',
        'share_purchase'
    ];

    protected $casts = [
        'date_of_entry' => 'date',
        'number_of_shares' => 'integer',
        'shareholding' => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    
    public function shareholder()
    {
        return $this->belongsTo(\App\Models\Shareholder::class, 'user_id');
        
    }
}