<?php

namespace App\Models;

use App\Models\AbstractModel;

class Store extends AbstractModel
{
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

}
