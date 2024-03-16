<?php

namespace App\Http\Controllers\Api\Customer\V1\Onboarding;

use App\Actions\CustomerActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Customer\V1\Onboarding\CreateNewUserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateNewCustomerController extends Controller
{
    public function __construct(
        private CustomerActions $customerActions
   )
   {

   }

    public function handle(CreateNewUserRequest $request)
    {
        $validatedRequest = $request->validated();
        $userType = $validatedRequest['user_type'];

        if ($userType == 'vendor') {
            DB::transaction(function () use ($validatedRequest) {
                $customer = $this->customerActions->createCustomerRecord([
                    'create_payload' => [
                        'full_name' => $validatedRequest['full_name'],
                        'phone_number' => $validatedRequest['phone_number'],
                        'email_address' => $validatedRequest['email_address'],
                        'address' => $validatedRequest['address'],
                        'nin_number' => $validatedRequest['nin_number'],
                        'user_type' => $validatedRequest['user_type'],
                        'password' => Hash::make($validatedRequest['password']),
                    ],
                ]);
            });

            $customer = $this->customerActions->getCustomerByEmail(
                $validatedRequest['email_address']
            );

            return successResponse(
                'Vendor record was created successfully',
                201,
                [
                    'access_token' => [
                        'type' => 'Bearer',
                        'user_type' => $customer->user_type,
                        'name' => $customer->full_name,
                        'token' => $customer->createToken('Customer AccessToken')->plainTextToken,
                    ],
                ]

            );
        }

        DB::transaction(function () use ($validatedRequest) {
            $customer = $this->customerActions->createCustomerRecord([
                'create_payload' => [
                    'full_name' => $validatedRequest['full_name'],
                    'phone_number' => $validatedRequest['phone_number'],
                    'email_address' => $validatedRequest['email_address'],
                    'address' => $validatedRequest['address'],
                    'user_type' => $validatedRequest['user_type'],
                    'password' => Hash::make($validatedRequest['password']),
                ],
            ]);
        });

        $customer = $this->customerActions->getCustomerByEmail(
            $validatedRequest['email_address']
        );

        return successResponse(
            'Customer record was created successfully!',
            201,
            [
                'access_token' => [
                    'type' => 'Bearer',
                    'user_type' => $customer->user_type,
                    'name' => $customer->full_name,
                    'token' => $customer->createToken('Customer AccessToken')->plainTextToken,
                ],
            ]
        );
    }
}
