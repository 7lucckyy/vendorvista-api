<?php

namespace App\Actions;

use App\Models\Customer;


class CustomerActions {

    public function __construct(
        private Customer $customer

    )
    {

    }

    public function createCustomerRecord($createCustomerRecordOptions)
    {
        $data = $createCustomerRecordOptions['create_payload'];

        return $this->customer->create($data);
    }

}