<?php

namespace App\Http\Controllers\Api\Vendor\V1\Fetch;

use App\Actions\CustomerActions;
use App\Actions\StoreActions;

class FetchVendorProfileController extends 
{
    public function __construct(
        private CustomerActions $customerActions,
        private StoreActions $storeActions,
    ){

    }

    public function handle()
    {
        $vendorId = auth()->id();

        
    }
}