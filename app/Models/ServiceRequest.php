<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends AbstractModel
{
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function artisan()
    {
        return $this->belongsTo(Artisan::class);
    }
}
