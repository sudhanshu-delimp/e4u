<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDO;

class Pricing extends Model
{
    use HasFactory;
    protected $table = "pricing";
    protected $guarded = ['id'];

    public function memberships()
    {
        return $this->belongsTo('App\Models\MembershipPlan', 'membership_id');
    }

    public static function getAdvertiserPrices($advertiserType=null){
        $prices = [];
        if(!empty($advertiserType)){
            switch($advertiserType){
                case ESCORT: {
                    $prices = self::whereIn('membership_id',[1,2,3])->pluck('price');
                }break;
                case MESSAGE_CENTER: {
                    $prices = self::whereIn('membership_id',[5])->pluck('price');
                }break;
            }
        }
        return $prices;
    }
}
