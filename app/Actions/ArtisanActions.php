<?php

namespace App\Actions;

use App\Models\Artisan;
use App\Models\ArtisanMedia;
use App\Models\Customer;

class ArtisanActions
{
    public function __construct(
        private Artisan $artisan,
        private ArtisanMedia $artisanMediaGallery,
        private Customer $customer,
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

    public function getArtisanProfile($entityId)
    {
        return $this->artisan->where([
            'customer_id' => $entityId,
        ])->first();
    }

    public function createArtisanMediaGalleryRecordOptions($createArtisanMediaGalleryRecordOptions, $relationship = [])
    {
        $data = $createArtisanMediaGalleryRecordOptions['create_payload'];
        entityId = $createArtisanMediaGalleryRecordOptions['entity_id'];
        $data = $createArtisanMediaGalleryRecordOptions['create_payload'];
        return $this->artisanMediaGallery->create($data);
    }
}