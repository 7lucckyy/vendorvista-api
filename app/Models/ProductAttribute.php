<?php

namespace App\Models;
use App\Models\AbstractModel;


class ProductAttribute extends AbstractModel
{
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function productAttributeValue()
    {
        return $this->hasOne(ProductAttributeValue::class, 'attribute_id');
    }

}
