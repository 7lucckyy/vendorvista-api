<?php

namespace App\Models;

class ProductImage extends AbstractModel
{
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    } 
}
