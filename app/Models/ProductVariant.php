<?php

namespace App\Models;

use App\Models\AbstractModel;



class ProductVariant extends AbstractModel
{
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
