<?php

namespace App\Actions;

use App\Models\Artisan;
use App\Models\Customer;
use App\Models\ServiceRequest;

class ServiceRequestActions 
{
    public function __construct(
        private ServiceRequest $serviceRequest,
        private Artisan $artisan,
        private Customer $customer,
    ){}

    public function createServiceRequestRecord($createServiceRequestRecordOptions)
    {   
        $data = $createServiceRequestRecordOptions['create_payload'];
        return $this->serviceRequest->create($data);
    }

    public function updateServiceRequestRecord($updateServiceRequestRecordOptions)
    {
        $entityId = $updateServiceRequestRecordOptions['entity_id'];
        $data = $updateServiceRequestRecordOptions['update_payload'];

        return $this->serviceRequest->where([
            'id' => $entityId,
        ])->update($data);
    }

    public function getServiceRequest($entityId)
    {
        return $this->serviceRequest->where([
            'customer_id' => $entityId,
        ])->first();
    }

    public function getAllServiceRequests()
    {
        return $this->serviceRequest->all();
    }

    public function getServiceRequestByStatus($status)
    {
        return $this->serviceRequest->where([
            'status' => $status,
        ])->get();
    }
}