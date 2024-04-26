<?php

namespace App\Models;

use App\Models\AbstractModel;


class Cart extends AbstractModel
{
    public function product_images()
    {
        return $this->belongsTo(ProductImage::class, 'product_id');
    }
    public function product()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
}
