<?php

namespace App\Models;

class Customer extends AbstractAuthenticatableModel
{
    public function store()
    {
        return $this->hasOne(Store::class, 'customer_id');
    }
}
