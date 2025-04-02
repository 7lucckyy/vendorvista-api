<?php

namespace App\Http\Controllers\Api\Store\V1\Fetch;

use App\Actions\StoreActions;
use App\Actions\ProductActions;
use App\Actions\CustomerActions;
use App\Http\Controllers\Controller;
use App\Actions\Access\VendorAccessActions;

class VendorProfileController extends Controller
{
    public function __construct(
        private ProductActions $productActions,
        private StoreActions $storeActions,
        private CustomerActions $customerActions,
        private VendorAccessActions $vendorAccessActions
    ) {
    }

    public function handle()
    {       
        $id = auth()->id();

        $user = auth()->user();

        $this->vendorAccessActions->execute($user);

        $store = $this->storeActions->getStoreById($id, ['account_details']);

        return successResponse('Store Profile Fetched Successfully', 200, 
            $store,
        );
    }
}
