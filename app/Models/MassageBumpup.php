<?php

namespace App\Models;

use App\Models\MassageProfile;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use App\Models\Model;

class MassageBumpup extends Model
{
    use HasFactory;
    protected $table = "massage_bumpup";
    protected $guarded = ['id'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function massage()
    {
        return $this->belongsTo(MassageProfile::class);
    }


    public function scopeActive($query)
    {
        return $query->where('utc_start_time', '<=', Carbon::now('UTC'))
        ->where('utc_end_time', '>=', Carbon::now('UTC'));
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

    public function paymentItems()
    {
        return $this->morphMany(PaymentItem::class, 'item');
    }
}
