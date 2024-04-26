<?php

namespace App\Actions;

use App\Models\Customer;

class CustomerActions
{
    public function __construct(
        private Customer $customer

    ) {
    }

    public function createCustomerRecord($createCustomerRecordOptions)
    {
        $data = $createCustomerRecordOptions['create_payload'];

        return $this->customer->create($data);
    }

    public function getCustomerByEmail($emailAddress)
    {
        return $this->customer->where([
            'email_address' => $emailAddress,
        ])->first();
    }

    public function getCustomerByID($customer_id)
    {
        return $this->customer->where([
            'id' => $customer_id,
        ])->first();
    }

    public function updateCustomerRecord($updateCustomerRecordOptions) 
    {
        $entity_id = $updateCustomerRecordOptions['entity_id'];
        $data = $updateCustomerRecordOptions['update_payload'];

        $this->customer->where([
            'id' => $entity_id,
        ])->update($data);
    }

    public function deleteCustomerRecord($deleteCustomerRecordOptions)
    {
        $entity_id = $deleteCustomerRecordOptions['customer_id'];

        return $this->customer->where([
            'id' => $entity_id,
        ])->delete();
    }

    public function getAllCustomers()
    {
        return $this->customer->all();
    }
}
