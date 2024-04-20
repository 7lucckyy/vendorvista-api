<?php

namespace App\Models;

class Order extends AbstractModel
{
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
