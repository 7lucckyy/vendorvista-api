<?php

namespace App\Models;

use App\Models\AbstractAuthenticatableModel;



class Vendor extends AbstractAuthenticatableModel
{
    public function storeProfile()
    {
        return $this->hasOne(Store::class, 'vendor_id');
    }
}
