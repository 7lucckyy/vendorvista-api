<?php

namespace App\Http\Controllers\Api\Customer\V1\ProfileManagement;

use App\Actions\CustomerActions;
use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Customer\V1\Authentication\ResetCustomerPasswordRequest;
use Illuminate\Support\Facades\Hash;

class ResetCustomerPasswordController extends Controller
{
    public function __construct(
        private CustomerActions $customerActions,

    ) {
    }

    public function handle(ResetCustomerPasswordRequest $request)
    {
        $validatedRequest = $request->validated();

        $customer = $this->customerActions->getCustomerByEmail(
            $request->email_address
        );

        if (is_null($customer)) {
            throw new NotFoundException('Customer record does not exist');
        }

        $customerId = $customer->id;

        $newPasswordHash = Hash::make($validatedRequest['password']);

        // Update the customer record with the new hashed password
        $this->customerActions->updateCustomerRecord([
            'entity_id' => $customerId,
            'update_payload' => [
                'password' => $newPasswordHash,
            ],
        ]);

        return successResponse(
            'Customer record was updated successfully',
            201,
            [
                'access_token' => [
                    'type' => 'Bearer',
                    'user_type' => $customer->user_type,
                    'token' => $customer->createToken('Customer AccessToken')->plainTextToken,
                ],
            ]
        );
    }
}
