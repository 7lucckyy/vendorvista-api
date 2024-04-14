<?php

namespace App\Models;

class Store extends AbstractModel
{
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function product(){
        return $this->hasMany(Product::class, 'store_id');
    }
}
