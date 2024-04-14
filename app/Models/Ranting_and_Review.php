<?php

namespace App\Models;

class Ranting_and_Review extends AbstractModel
{
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
