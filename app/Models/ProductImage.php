<?php

namespace App\Models;



class ProductImage extends AbstractModel
{
    public function product()
    {
        return $this->belongsToMany(Product::class, 'product_id');
    }
}


