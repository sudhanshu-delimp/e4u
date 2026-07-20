<?php

namespace App\Models;

use App\Models\ShareholderSetting;
use App\Models\ShareholderContact;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use App\Models\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

//use Illuminate\Support\Facades\DB;

class Shareholder extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = "users";
    protected $impersonatedId;

    protected $casts = [
        'contact_type' => 'array',
    ];

    public function __construct() {
        $this->impersonatedId = 0;
         if (Session::isStarted()) {
            $this->impersonatedId = Session::get('parent_user_id');
        }
    }

    public function shareholder_setting()
    {
        return $this->hasOne(ShareholderSetting::class, 'user_id', 'id');
    }

    public function contacts()
    {
        return $this->hasMany(ShareholderContact::class, 'user_id', 'id');
    }

    public function setting()
    {
        return $this->hasOne('App\Models\ShareholderSetting', 'staff_id');
    }
    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id');
    }

    public function state()
    {
        return $this->belongsTo('App\Models\State', 'state_id');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id');
    }

    public function LoginStatus()
    {
        return $this->hasOne(LoginAttempt::class,  'user_id', 'id');
    }

    public function account_setting()
    {
        return $this->belongsTo(AccountSetting::class, 'id', 'user_id');
    }

    public function createddBy()
    {
        return $this->belongsTo(User::class, 'created_by')
            ->select('id', 'member_id', 'name', 'business_name');
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

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by')
            ->select('id', 'member_id', 'name', 'business_name');
    }
    public function getStatusAttribute($value)
    {
        $map = [
            '1' => 'Active',
            '2' => 'Pending',
            '3' => 'Suspended',
            '4' => 'Blocked',
            '5' => 'Registered',
            '6' => 'On Hold',
            '7' => 'Rejected',
            '8' => 'Cancelled',
        ];

        return $map[$value] ?? 'Unknown';
    }

    public function setMemberIdAttribute($value)
    {
        // If value is provided, use it, otherwise generate based on type and state
        if (empty($value)) {
            $memberId = $this->generateMemberId();
            $this->attributes['member_id'] = $memberId;
        } else {
            $this->attributes['member_id'] = $value;
        }
    }

    public function getTypeAttribute($value)
    {
        return (int) $value;
    }

    public function generateMemberId()
    {
        //Shareholder
        if ($this->type == 8) {
            return 'B' . sprintf("%05d", $this->id);
        }
    }

    /**
     * Boot method to automatically set member_id when user is created
     */
    protected static function boot()
    {
        parent::boot();
        static::created(function ($user) {
            // Only set member_id if it's not already set
            if (empty($user->member_id)) {
                if ($user->generateMemberId()) {
                    $user->member_id = $user->generateMemberId();
                    $user->created_by = Auth::id();

                    $user->save();
                }
            }
        });
        return null;
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    { 
        static::saving(function ($model) {
            if (auth()->check()) {
                $model->updated_by =Auth::id();
            }
        });
    }


    public function getPhoneAttribute($value)
    {
        return formatMobileNumber($value);
    }

    public function setPhoneAttribute($value)
    {
        $clean = removeSpaceFromString($value);
        $this->attributes['phone'] = $clean;
    }

    public function getBusinessNumberAttribute($value)
    {
        return formatMobileNumber($value);
    }

    public function setBusinessNumberAttribute($value)
    {
        $clean = removeSpaceFromString($value);
        $this->attributes['business_number'] = $clean;
    }

    public function getAbnAttribute($value)
    {
        return formatAbnNumber($value);
    }

    public function setAbnAttribute($value)
    {
        $clean = removeSpaceFromString($value);
        $this->attributes['abn'] = $clean;
    }

    /**
     * Get shareholder list
     * @param string $status
     * @param array $columns
     * @return App\Models\Shareholder $shareholders
     */
    public function getList($status = "", $columns = [])
    {
        $selectColoums = ['id', 'member_id', 'email', 'phone', 'country_id', 'city_id', 'state_id', 'status', 'name', 'type', 'gender', 'operator_id', 'created_by', 'updated_by', 'created_at', 'business_name'];
        if (is_array($columns) && count($columns) > 0) {
            $selectColoums = $columns;
        }
        if ((int)$status > 0) {
            $shareholders = $this->select($selectColoums)->where('status', $status)->where('type', '8')->get();
        } else {
            $shareholders = $this->select($selectColoums)->where('type', '8')->get();
        }
        return $shareholders;
    }

    /**
     * Get shareholder list for dropdown
     * 
     * @param string $status
     * @return App\Models\Operator $shareholders
     */
    public function getDropdownList($status = "")
    {
        $shareholders = $this->getList($status, ['id', 'business_name', 'name'])->pluck('name', 'id');
        return $shareholders;
    }
}
