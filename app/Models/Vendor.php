<?php

namespace App\Models;

use App\Models\AbstractAuthenticatableModel;



class Vendor extends AbstractAuthenticatableModel
{
    public function store()
    {
        return $this->hasOne(Store::class, 'vendor_id');
    }
}
