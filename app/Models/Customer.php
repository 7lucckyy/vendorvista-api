<?php

namespace App\Models;

use App\Models\AbstractAuthenticatableModel;



class Customer extends AbstractAuthenticatableModel
{

    public function store()
    {
        return $this->hasOne(Store::class, 'customer_id');
    }
}
