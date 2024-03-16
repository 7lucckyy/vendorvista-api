<?php

namespace App\Models;

class Product extends AbstractModel
{
    public function product_images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
}
