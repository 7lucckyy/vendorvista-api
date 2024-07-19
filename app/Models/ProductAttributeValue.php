<?php
namespace App\Models;

use App\Models\AbstractModel;

class ProductAttributeValue extends AbstractModel
{
    public function productAttribute()
    {
        return $this->belongsTo(ProductAttribute::class, 'attribute_id');
    }
}
