<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
  use HasFactory;
  protected $fillable = [
    'order_id',
    'type',
    'phone',
    'email',
    'address_line1',
    'address_line2',
    'city',
    'state',
    'country',
    'pincode',
    'landmark',
  ];


  public function getPhoneAttribute($value)
  {
    return formatMobileNumber($value);
  }

  public function setPhoneAttribute($value)
  {

    $clean = removeSpaceFromString($value);
    $this->attributes['phone'] = $clean;
  }
}
