<?php

namespace App\Models;

class Store extends AbstractModel
{
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
