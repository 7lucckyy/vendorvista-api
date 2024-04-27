<?php

namespace App\Models;

use App\Models\AbstractModel;


class Cart extends AbstractModel
{
  
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
