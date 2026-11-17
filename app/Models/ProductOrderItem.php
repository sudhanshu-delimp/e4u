<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
class ProductOrderItem extends Model
{
  use HasFactory;

  protected $fillable = [
    'order_id',
    'product_id',
    'quantity',
    'retail_price',
    'price',
    'total',
  ];

  public function product()
  {
    return $this->belongsTo(Product::class, 'product_id', 'id');
  }
  public function productOrder()
  {
    return $this->belongsTo(ProductOrder::class, 'order_id', 'id');
  }
  public function paymentItems(): MorphMany
    {
        return $this->morphMany(PaymentItem::class, 'item');
    }
  
}
