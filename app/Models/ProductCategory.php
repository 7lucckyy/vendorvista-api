<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends AbstractModel
{
    public function product()
    {
        return $this->belongsToMany(Product::class, 'product_id');
    }
}
