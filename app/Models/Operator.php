<?php

namespace App\Models;

use App\Models\OperatorDetail;
use App\Models\OperatorSetting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Operator extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = "users";

    protected $casts = [
        'contact_type' => 'array',
    ];

    public function operator_detail()
    {
        return $this->belongsTo(OperatorDetail::class,  'id', 'user_id');
    }
    public function operator_setting()
    {
        return $this->belongsTo(OperatorSetting::class, 'id', 'user_id');
    }

    public function setting()
    {
        return $this->hasOne('App\Models\OperatorSetting', 'staff_id');
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
        static::created(function ($operator) {
            \App\Models\OperatorSetting::create([
                'user_id' => $operator->id, // operator_detail.id
                'idle_preference_time' => '30',
                'twofa' => '2',
            ]);
        });
    }

    /**
     * Get opertor list
     * @param string $status
     * @param array $columns
     * @return App\Models\Operator $operators
     */
    public function getList($status = "", $columns = [])
    {
        $selectColoums = ['id', 'member_id', 'email', 'phone', 'country_id', 'city_id', 'state_id', 'status', 'name', 'type', 'gender', 'operator_id', 'created_by', 'updated_by', 'created_at', 'business_name'];
        if (is_array($columns) && count($columns) > 0) {
            $selectColoums = $columns;
        }
        if ((int)$status > 0) {
            $operators = $this->select($selectColoums)->where('status', $status)->where('type', '7')->get();
        } else {
            $operators = $this->select($selectColoums)->where('type', '7')->get();
        }
        return $operators;
    }

    /**
     * Get operator list for dropdown
     * 
     * @param string $status
     * @return App\Models\Operator $operators
     */
    public function getDropdownList($status = "")
    {
        $operators = $this->getList($status, ['id', 'business_name', 'name'])->pluck('name', 'id');
        return $operators;
    }

    /**
     * Get operator list for dropdown
     * 
     * @param string $status
     * @return App\Models\Operator $operators
     */
    public function getOperatorGreaterThanCountryProvidedCount()
    {
        $howManyOperatorSamecountry = config('operator.how_many_operator_same_country');
        $tableName = $this->getTable();
        $users = DB::table($tableName . ' as u')
            ->select(DB::raw('MIN(u.id) as id'), 'u.country_id')
            ->where('u.type', '7')
            ->whereIn('u.country_id', function ($query) use ($tableName, $howManyOperatorSamecountry) {
                $query->select('country_id')
                    ->from($tableName)
                    ->where('type', '7')
                    ->groupBy('country_id')
                    ->havingRaw('COUNT(*) >= ' . $howManyOperatorSamecountry);
            })
            ->groupBy('u.country_id')
            ->get()->pluck('country_id', 'country_id');
        return $users;
    }

    public function getCountryNotAssignToOperator($editCountry = 0)
    {
        $countryList = config('operator.country');
        $OperatorGreaterThanCountryProvidedCount = $this->getOperatorGreaterThanCountryProvidedCount();
        if($OperatorGreaterThanCountryProvidedCount->count() > 0) {
            $OperatorGreaterThanCountryProvidedCount = $OperatorGreaterThanCountryProvidedCount->toArray();
            if($editCountry > 0) {
                if(in_array($editCountry,  $OperatorGreaterThanCountryProvidedCount)) {
                    unset($OperatorGreaterThanCountryProvidedCount[$editCountry]);
                }
            }
            $countryList = array_diff_key($countryList, $OperatorGreaterThanCountryProvidedCount);
        }
        return $countryList;
    }
}
