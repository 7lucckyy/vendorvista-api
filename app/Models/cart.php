<?php

namespace App\Models;

use App\Models\Product;


class Cart extends AbstractModel
{
    public function product()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');    
    }

}
