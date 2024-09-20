<?php

namespace App\Http\Controllers\Api\Delivery\Address;

use App\Actions\CustomerActions;
use App\Actions\DeliveryAddressActions;
use App\Http\Controllers\Controller;

class DeliveryAddressController extends Controller 
{
    public function __construct(
        private DeliveryAddressActions $deliveryAddressActions
    ){}

    public function handle()
    {
        
    }
}