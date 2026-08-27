<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use App\Models\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = ['parent_id', 'escort_id', 'start_date', 'end_date', 'membership', 'utc_start_time', 'utc_end_time', 'status', 'suspended_at', 'cancelled_at', 'tour_location_id', 'rate', 'discount_rate', 'special_discount_value', 'special_discount_type', 'total_rate', 'paid_rate', 'created_by', 'updated_by'];
    protected $table = 'purchase';
    public $timestamps = true;


    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function paymentItems()
    {
        return $this->morphMany(PaymentItem::class, 'item');
    }

    public function suspendProfile()
    {
        return $this->hasMany(SuspendProfile::class, 'purchase_id');
    }

    public function upcomingSuspends()
    {
        return $this->suspendProfile()
            ->where('utc_start_date', '>', now('UTC'));
    }

    public function activeSuspendProfile()
    {
        return $this->hasMany(SuspendProfile::class, 'purchase_id')
            ->where('utc_start_date', '<=', Carbon::now('UTC'))
            ->where('utc_end_date', '>=', Carbon::now('UTC'));
    }

    public function activeUpcomingSuspend()
    {
        return $this->hasOne(SuspendProfile::class, 'purchase_id')
            ->where('utc_end_date', '>=', Carbon::now('UTC'))
            ->oldestOfMany('utc_start_date');
    }

    public function isListingExtended()
    {
        $extendedPurchase = self::where('escort_id', $this->escort_id)
            ->where('start_date', Carbon::parse($this->end_date)->addDay())
            ->first();

        return (object) [
            'count' => !is_null($extendedPurchase),
            'data'  => $extendedPurchase,
        ];
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = empty($value) ? null : Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = empty($value) ? null : Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }

    public function getStartDateAttribute($value)
    {
        return !empty($value)
            ? Carbon::parse($value)->format('d-m-Y')
            : null;
    }

    public function getEndDateAttribute($value)
    {
        return !empty($value)
            ? Carbon::parse($value)->format('d-m-Y')
            : null;
    }

    public function getDaysNumberAttribute()
    {
        return Carbon::parse($this->start_date)
            ->diffInDays(Carbon::parse($this->end_date)) + 1;
    }

    public function getDaysLeftAttribute()
    {
        $now = Carbon::now()->startOfDay();
        $startDate = Carbon::parse(date('d-m-Y', strtotime($this->start_date)))->startOfDay();
        $endDate = Carbon::parse(date('d-m-Y', strtotime($this->end_date)))->startOfDay();
        if ($startDate > $now) {
            return '-';
        } else if ($endDate < $now) {
            return '0';
        } else {
            $left =  Carbon::parse(now())->diffInDays(Carbon::parse($this->end_date)) + 1;
        }
        return  $left;
    }

    public function getMembershipTypeAttribute($value)
    {
        return getMembershipType($this->membership);
    }

    public function getPreviousMembershipTypeAttribute()
    {
        return getMembershipType($this->parent->membership);
    }

    public function escort()
    {
        return $this->belongsTo(Escort::class, 'escort_id');
    }

    public function advertiser()
    {
        return $this->belongsTo(Escort::class, 'escort_id');
    }

    public function user()
    {
        return $this->escort->user;
    }

    public function tour_location()
    {
        return $this->belongsTo(TourLocation::class);
    }

    public function scopeOverlapping($query, $start, $end)
    {
        $formatted_start = Carbon::createFromFormat('d-m-Y', $start)->format('Y-m-d');
        $formatted_end = Carbon::createFromFormat('d-m-Y', $end)->format('Y-m-d');

        return $query->whereIn('status', ['listed', 'pending'])->where('start_date', '<=', $formatted_end)->where('end_date', '>=', $formatted_start);
    }

    public function availabilityFromA($day)
    {
        if (!$availability = $this->availability) {
            $availability = $this->availability()->make();
        }
        if ($attribute =  $availability->{$day . '_from'}) {
            return Carbon::createFromFormat('H:i:s', $attribute)->format('A');
        }

        return null;
    }

    public function availabilityToA($day)
    {
        if (!$availability = $this->availability) {
            $availability = $this->availability()->make();
        }
        if ($attribute =  $availability->{$day . '_to'}) {
            return Carbon::createFromFormat('H:i:s', $attribute)->format('A');
        }
        return null;
    }

    public function getLeftListingDaysAttribute()
    {
        $todayDate = $this->escort->today;
        $listEndDate = getEscortLocalTime($this->utc_end_time, $this->escort->timezone);
        return $todayDate->diffInDays($listEndDate);
    }

    public function getRefundAmountAttribute()
    {
        $todayDate = $this->escort->today;
        if ($todayDate->gte($this->start_date)) { /* To Know Listing has been started or not  */
            list($usedDicount, $amount) = calculateTotalFee($this->membership, ($this->days_number - $this->left_listing_days), $this);
            $amount = $this->paid_rate - $amount;
        } else {
            list($usedDicount, $amount) = calculateTotalFee($this->membership, $this->days_number, $this);
        }

        $gstAmount = getGSTAmount($amount);
        $amount = $amount + $gstAmount;
        return number_format($amount, 2, '.', '');
    }

    public function transactions()
    {
        return $this->morphMany(CreditTransaction::class, 'transactionable');
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
