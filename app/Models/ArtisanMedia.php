<?php

namespace App\Models;

class ArtisanMedia extends AbstractModel
{
    public function artisan ()
    {
        return $this->belongsTo(Artisan::class, 'artisan_id');
    }
}
