<?php

namespace App\Models;

use App\Models\SupplierDetail;
use App\Models\SupplierSetting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
        return $this->belongsTo(SupplierDetail::class,  'id', 'user_id');
    }
    public function supplier_setting()
    {
        return $this->belongsTo(SupplierSetting::class, 'id', 'user_id');
    }

    public function setting()
    {
        return $this->hasOne('App\Models\SupplierSetting', 'staff_id');
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

    protected static function boot()
    {
        parent::boot();
        static::created(function ($supplier) {
            \App\Models\SupplierSetting::create([
                'user_id' => $supplier->id, // operator_detail.id
                'idle_preference_time' => '30',
                'twofa' => '2',
            ]);
        });
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
