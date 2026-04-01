<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierDetail extends Model
{
    use HasFactory;
    protected $table = 'supplier_details';

    protected $fillable = [
        'user_id',
        'date_appointed',
        'point_of_contact',
        'concierge_service',
        'agreement_date',
        'term',
        'fee',
        'commission_advertising',
        'commission_advertising_type',
        'commission_massage_centre',
        'commission_massage_centre_type',
        'agreement_file',
        'created_at',
        'updated_at',
    ];
    protected $hidden = ['updated_at'];

}
