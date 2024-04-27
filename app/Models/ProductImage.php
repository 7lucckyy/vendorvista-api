<?php

namespace App\Models;

class ProductImage extends AbstractModel
{
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'product_id');
    }
}
