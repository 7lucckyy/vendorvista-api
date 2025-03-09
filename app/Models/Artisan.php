<?php

namespace App\Models;

use App\Models\Customer;
use App\Models\ArtisanMedia;


class Artisan extends AbstractModel
{
    public function customer()
    {
        return $this->belongsTo(related: Customer::class);
    }

    public function gallery()
    {
        return $this->hasMany(related: ArtisanMedia::class);
    }
}
