<?php

namespace App\Models;

class Order extends AbstractModel
{
    public function product()
    {
        return $this->belongsToMany(Product::class, 'product_id');
    }
}
