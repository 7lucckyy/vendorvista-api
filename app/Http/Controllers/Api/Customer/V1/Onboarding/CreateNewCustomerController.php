<?php

namespace App\Http\Controllers\Api\Customer\V1\Onboarding;

use Illuminate\Http\Request;
use App\Actions\CustomerActions;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\Customer\V1\Onboarding\CreateCustomerRequest;

class CreateNewCustomerController extends Controller
{

   public function __construct(
    private CustomerActions $customerActions
   ){

   }

   public function handle(CreateCustomerRequest $request){
      
        $validatedRequest = $request->validated();

        DB::transaction(function () use ($validatedRequest) {
            $customer = $this->customerActions->createCustomerRecord([
                'create_payload' => [
                    'first_name' => $validatedRequest['first_name'],
                    'last_name' => $validatedRequest['last_name'],
                    'phone_number' => $validatedRequest['phone_number'],
                    'email_address' => $validatedRequest['email_address'],
                    'password'=> Hash::make($validatedRequest['password'])
                ]
            ]);
        });
        return successResponse(
            'Customer record was created successfully',
            201,
        );
   }
}
