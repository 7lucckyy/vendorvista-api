<?php

namespace App\Models;


class Artisan extends AbstractModel
{
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
