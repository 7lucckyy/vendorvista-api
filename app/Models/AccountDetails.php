<?php

namespace App\Models;

use App\Models\AbstractModel;



class AccountDetails extends AbstractModel
{
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}
