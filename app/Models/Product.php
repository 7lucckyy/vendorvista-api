<?php

namespace App\Models;

class Product extends AbstractModel
{
    public function product_images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function product_likes()
    {
        return $this->hasMany(ProductLike::class, 'product_id');
 
    }

    public function product_categories()
    {
        return $this->hasMany(ProductCategory::class, 'product_id');
    }

    public function product_ratings()
    {
        return $this->hasMany(Ranting_and_Review::class, 'product_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function order()
    {
        return $this->hasMany(Order::class, 'product_id');
    }
    
    public function cart()
    {
        return $this->belongsToMany(Cart::class)->withPivot('quantity');
    }
        
}
