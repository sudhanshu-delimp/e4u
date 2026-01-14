<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperatorDetail extends Model
{
    use HasFactory;
    protected $table = 'operator_details';

    protected $fillable = [
        'user_id',
        'date_appointed',
        'point_of_contact',
        'agreement_date',
        'term',
        'fee',
        'commission_advertising_percent',
        'commission_massage_centre_percent',
        'created_at',
        'updated_at',
    ];
    protected $hidden = ['updated_at'];

}
