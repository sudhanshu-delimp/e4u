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
        return $this->belongsTo(TourLocation::class,'tour_location_id');
    }

    public function escort()
    {
        return $this->belongsTo(Escort::class,'escort_id');
    }

    public function escortPinup()
    {
        return $this->belongsTo(EscortPinup::class, 'is_pinup', 'id');
    }
}
