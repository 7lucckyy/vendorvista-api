<?php

namespace App\Models;

use App\Models\Product;


class ProductLike extends AbstractModel
{
    public function product()
    {
        return $this->belongsToMany(Product::class, 'product_id');
    }
}
