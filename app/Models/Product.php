<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  use HasFactory;

  public function getImageAttribute()
  {
    return $this->attributes['image']
        ? asset('admin/products/' . $this->attributes['image'])
        : asset('admin/products/escort.jpg');
  }
}
