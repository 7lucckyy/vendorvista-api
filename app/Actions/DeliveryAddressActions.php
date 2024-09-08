<?php

namespace App\Actions;
use App\Models\DeliveryAddress;


class DeliveryAddressActions 
{
 
    public function __construct(
        private DeliveryAddress $deliveryAddress
    ){}

    public function createDeliveryAddressRecord($createCurrentAddressRecordOptions)
    {
        $data = $createCurrentAddressRecordOptions['create_payload'];

        return $this->deliveryAddress->create($data);
    }

    public function getDeliveryAddressRecord($entity_id)
    {
        return $this->deliveryAddress->where('customer_id', $entity_id)->first();

    }

    public function updateDeliveryAddressAddressRecord($updateDeliveryAddressRecordOptions)
    {
        $entity_id = $updateDeliveryAddressRecordOptions['customer_id'];
        $data = $updateDeliveryAddressRecordOptions['update_payload'];

        return $this->deliveryAddress->where('customer_id', $entity_id)
        ->update($data);
    }

    public function deleteDeliveryAddressRecord($deleteDeliveryAddressRecordOptions)
    {
        $entity_id = $deleteDeliveryAddressRecordOptions['customer_id'];

        return $this->deliveryAddress
        ->where('customer_id', $entity_id)
        ->delete();
    }

}