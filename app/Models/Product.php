<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

  public function getImageAttribute($value)
{
    return $value
        ? asset('admin/products/escort.jpg')
        : asset('admin/products/escort.jpg');
}
}
