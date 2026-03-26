<?php
namespace App\Models;

use App\Models\SupplierDetail;
use App\Models\SupplierBankDetail;
use App\Models\SupplierSetting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

//use Illuminate\Support\Facades\DB;

class Supplier extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = "users";

    protected $casts = [
        'contact_type' => 'array',
    ];

    public function supplier_detail()
    {
        return $this->hasOne(SupplierDetail::class, 'user_id' ,'id');
    }
    public function supplier_setting()
    {
        return $this->hasOne(SupplierSetting::class, 'user_id' ,'id');
    }
    public function supplier_bank_detail()
    {
        return $this->hasOne(SupplierBankDetail::class, 'user_id' ,'id');
    }

    public function setting()
    {
        return $this->hasOne('App\Models\SupplierSetting', 'staff_id');
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
       //Supplier
        if ($this->type == 10) {
            return 'P' . config('escorts.profile.statesName')[$this->state->name] . sprintf("%04d", $this->id);
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
                    //$user->created_by = Auth::id();
                    $user->save();
                }
            }
        });
        return null;
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
     * Get suppliers list
     * @param string $status
     * @param array $columns
     * @return App\Models\Supplier $suppliers
     */
    public function getList($status = "", $columns = [])
    {
        $selectColoums = ['id', 'member_id', 'email', 'phone', 'country_id', 'city_id', 'state_id', 'status', 'name', 'type', 'gender', 'operator_id', 'created_by', 'updated_by', 'created_at', 'business_name'];
        if (is_array($columns) && count($columns) > 0) {
            $selectColoums = $columns;
        }
        if ((int)$status > 0) {
            $suppliers = $this->select($selectColoums)->where('status', $status)->where('type', '10')->get();
        } else {
            $suppliers = $this->select($selectColoums)->where('type', '10')->get();
        }
        return $suppliers;
    }

    /**
     * Get supplier list for dropdown
     * 
     * @param string $status
     * @return App\Models\Operator $suppliers
     */
    public function getDropdownList($status = "")
    {
        $suppliers = $this->getList($status, ['id', 'business_name', 'name'])->pluck('name', 'id');
        return $suppliers;
    }

}
