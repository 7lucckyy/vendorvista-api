<?php

namespace App\Actions;

use App\Models\Vendor;


Class VendorActions {
    public function __construct (
        private Vendor $vendor
    ){
    
    }

    public function createVendorRecord($createVendorRecordOptions)
    {
        $data = $createVendorRecordOptions['vendor_payload'];

        return $this->vendor->create($data);
    }

    public function updateVendorRecord($updateVendorRecordOptions)
    {
        $entity_id = $updateVendorRecordOptions['entity_id'];
        $data = $updateVendorRecordOptions['update_payload'];

        $this->vendor->where([
            'id' => $entity_id
        ])->update($data);
    }


    public function deleteVendorRecord($deleteVendorRecordOptions){
        $entity_id = $deleteVendorRecordOptions['entity_id'];

        return $this->vendor->where([
            'id' => $entity_id
        ])->delete();
    }

    public function getVendorById($getVendorByIdRecordOptions)
    
    {
        $entity_id = $getVendorByIdRecordOptions['entity_id'];

        return $this->vendor->where([
            'id' => $entity_id
        ])->first();
    }

    public function getVendorByEmail($emailAddress)
    {
        return $this->vendor->where([
            'email_address' => $emailAddress
        ])->first();
    }

    public function listVendorsRecord()
    {   
        return $this->vendor->latest()->paginate();
    }
}





