<?php

namespace App\Models;

use App\Models\MassageProfile;
use App\Models\MassageSuspendProfile;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use App\Models\Model;
use Illuminate\Support\Facades\Log;

class MassagePurchase extends Model
{
    use HasFactory;
    
    protected $table = 'massage_purchases';
    protected $fillable = [
        'parent_id',
        'membership_id',
        'massage_centre_id',
        'massage_profile_id',
        'start_date',
        'utc_start_time',
        'end_date',
        'utc_end_time',
        'status',
        'rate',
        'discount_rate',
        'total_rate',
        'paid_rate',
    ];


    public function activeSuspendProfile()
    {
        $now = Carbon::now('UTC');    
        return $this->hasMany(MassageSuspendProfile::class, 'massage_profile_id','massage_profile_id')
            ->where('utc_start_date', '<=',$now)
            ->where('utc_end_date', '>=', $now);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'massage_centre_id');
    }

    public function massageprofile()
    {
        return $this->hasOne(MassageProfile::class, 'id', 'massage_profile_id');
    }
    
    
    
    public function brb()
    {
        return $this->hasMany('App\Models\MassageBrb', 'profile_id','massage_profile_id');
    }

    public function activeUpcomingSuspend(){
        return $this->hasOne(MassageSuspendProfile::class, 'massage_profile_id','massage_profile_id')
        ->where('utc_end_date', '>=', Carbon::now('UTC'))
        ->oldestOfMany('utc_start_date');
    }


    public function scopeOverlapping($query, $start, $end)
    {
        $formatted_start = Carbon::createFromFormat('d-m-Y', $start)->format('Y-m-d');
        $formatted_end = Carbon::createFromFormat('d-m-Y', $end)->format('Y-m-d');

        return $query->whereIn('status',['listed','pending'])->where('start_date', '<=', $formatted_end)->where('end_date', '>=', $formatted_start);
    }

    /**
     * Indicates if the model should have created_by and updated_by fields.
     *
     * @var bool
     */
    public $createdUpdatedBy = true;

    /**
     * Get the created by that owns the details.
     */
    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    /**
     * Get the updated by that owns the details.
     */
    public function updatedBy()
    {
        return $this->belongsTo('App\Models\User', 'updated_by');
    }

    public function commissions()
    {
        return $this->morphMany(AgentCommission::class, 'commissionable');
    }
}
