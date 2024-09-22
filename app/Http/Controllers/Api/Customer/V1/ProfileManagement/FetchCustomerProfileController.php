<?php


namespace App\Http\Controllers\Api\Customer\V1\ProfileManagement;

use App\Actions\CustomerActions;
use App\Actions\CustomerAddressActions;
use App\Http\Controllers\Controller;

class FetchCustomerProfileController extends Controller
{
    public function __construct(
        private CustomerActions $customerActions,
        private CustomerAddressActions $customerAddressActions,
    ){}

    public function handle()
    {
        $customerId = auth()->id();

        $relationships = ['currentAddress'];

        $customerProfile = $this->customerActions->getCustomerByID([$customerId, $relationships]);

        return successResponse('Profile retrieved successfully', 200, $customerProfile);
    }
}