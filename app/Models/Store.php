<?php

namespace App\Models;

class Store extends AbstractModel
{
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function product(){
        return $this->hasMany(Product::class, 'store_id');
    }

    public function account_details()
    {
        return $this->hasOne(AccountDetails::class, 'store_id');
    }
    public function social_media_links()
    {
        return $this->hasMany(StoreSocialMediaLink::class, 'store_id');
    }
}
