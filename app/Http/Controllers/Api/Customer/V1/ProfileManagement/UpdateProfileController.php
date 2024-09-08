<?php


namespace App\Http\Controllers\Api\Customer\V1\ProfileManagement;

use App\Actions\CustomerActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Customer\V1\Update\UpdateProfileRequest;

class UpdateProfileController extends Controller 
{
    public function __construct(
        private CustomerActions $customerActions
    ){}

    public function handle(UpdateProfileRequest $updateProfileRequest)
    {
        $userID = auth()->id();
        $validatedRequest = $updateProfileRequest->validated();

        $this->customerActions->updateCustomerRecord([
            'customer_id' => $userID,
            'update_payload' => $validatedRequest
        ]);

        return successResponse('Profile updated successfully', 200);
        
    }
}