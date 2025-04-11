<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourProfile extends Model
{
    use HasFactory;

    protected $fillable = ['tour_location_id', 'escort_id', 'tour_plan'];

    public function location()
    {
        return $this->belongsTo(TourLocation::class);
    }

    public function escort()
    {
        return $this->belongsTo(Escort::class);
    }
}
