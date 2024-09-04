<?php

namespace App\Actions;


use App\Models\UserCurrentAddress;

class CustomerAddressActions 
{
    public function __construct(
        private UserCurrentAddress $userCurrentAddress,
    ){}

    public function createCurrentAddressRecord($createCurrentAddressRecordOptions)
    {
        $data = $createCurrentAddressRecordOptions['create_payload'];

        return $this->userCurrentAddress->create($data);
    }

    public function getCurrentAddressRecord($entity_id)
    {
        return $this->userCurrentAddress->where('id', $entity_id)->first();

    }

    public function updateCurrentAddressRecord($updateUserCurrentAddressRecordOptions)
    {
        $entity_id = $updateUserCurrentAddressRecordOptions['id'];
        $data = $updateUserCurrentAddressRecordOptions['update_payload'];

        return $this->userCurrentAddress->where('id', $entity_id)
        ->update($data);
    }

    public function deleteUserCurrentAddressRecord($deleteUserCurrentAddressRecordOptions)
    {
        $entity_id = $deleteUserCurrentAddressRecordOptions['id'];
        $data = $deleteUserCurrentAddressRecordOptions['delete_record_payload'];

        return $this->userCurrentAddress
        ->where('id', $entity_id)
        ->delete();
    }
}