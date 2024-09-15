<?php

namespace App\Models;


class Order extends AbstractModel
{
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

   public function deliveryAddress()
   {
        return $this->hasMany(DeliveryAddress::class, 'order_id');
   }
   public function customer()
   {
        return $this->belongsTo(Customer::class, 'customer_id');
   }
}
