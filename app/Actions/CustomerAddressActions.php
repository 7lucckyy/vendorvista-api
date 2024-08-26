<?php

namespace App\Actions;

use App\Models\Customer;
use App\Models\DeliveryAddress;
use App\Models\UserCurrentAddress;

class CustomerAddressActions 
{
    public function __construct(
        private UserCurrentAddress $userCurrentAddress,
        private DeliveryAddress $deliveryAddress,
    ){}

    public function createCurrentAddressRecord($createCurrentAddressRecordOptions)
    {
        
    }
}