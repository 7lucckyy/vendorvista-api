<?php

namespace App\Models;

use App\Models\AbstractModel;


class Product extends AbstractModel
{
    public function product_images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
}
