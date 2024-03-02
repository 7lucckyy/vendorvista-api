<?php

namespace App\Models;

use App\Models\AbstractModel;

class Store extends AbstractModel
{
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

}
