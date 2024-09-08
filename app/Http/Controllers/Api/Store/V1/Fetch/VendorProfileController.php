<?php

namespace App\Http\Controllers\Api\Store\V1\Fetch;

use App\Actions\CustomerActions;
use App\Actions\StoreActions;
use App\Actions\ProductActions;
use App\Http\Controllers\Controller;

class VendorProfileController extends Controller
{
    public function __construct(
        private ProductActions $productActions,
        private StoreActions $storeActions,
        private CustomerActions $customerActions,
    ) {
    }

    public function handle()
    {       
        $id = auth()->id();

        $store = $this->storeActions->getStoreById($id, ['account_details']);

        return successResponse('Store Profile Fetched Successfully', 200, 
            $store,
        );
    }
}
