<?php

namespace App\Models;

use App\Models\Customer;
use App\Models\ArtisanSkill;


class Artisan extends AbstractModel
{
    public function customer()
    {
        return $this->belongsTo(related: Customer::class);
    }

    public function artisanSkill()
    {
        return $this->hasOne(related: ArtisanSkill::class);
    }
}
