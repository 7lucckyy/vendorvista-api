<?php

namespace App\Models;



class StoreSocialMediaLink extends AbstractModel
{
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}
