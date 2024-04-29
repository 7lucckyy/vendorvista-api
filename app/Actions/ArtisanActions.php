<?php

namespace App\Actions;

use App\Models\Artisan;
use App\Models\Customer;

class ArtisanActions
{
    public function __construct(
        private Artisan $artisan,
        private Customer $customer
    ){}

    public function createArtisanRecord($createArtisanRecordOptions)
    {   
        $data = $createArtisanRecordOptions['create_payload'];
        return $this->artisan->create($data);
    }

    public function updateArtisanRecord($updateArtisanRecordOptions)
    {
        $entityId = $updateArtisanRecordOptions['entity_id'];
        $data = $updateArtisanRecordOptions['update_payload'];

        return $this->artisan->where([
            'id' => $entityId,
        ])->update($data);

    }
}