<?php

namespace App\Http\Controllers\Api\Customer\V1\Authentication;

use App\Http\Requests\Api\Customer\V1\Authentication\CustomerAuthenticateRequest;


use App\Actions\CustomerActions;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\NotFoundException;

class AuthenticateCustomerController extends Controller

{

    public function __construct(
        private CustomerActions $customerActions,

    ){

    }
    public function handle(CustomerAuthenticateRequest $request)
    {
        $customer = $this->customerActions->getCustomerByEmail(
            $request->email_address
        );
        
        if (is_null($customer))
        {
            throw new NotFoundException('Customer record does not exist');

        }
        if (Hash::check($request->password, $customer->password) === false) {
            throw new NotFoundException('Customer record does not exist');
        }

        return successResponse(
            'Customer account was logged in successfully',
            201,
            
            [
                'access_token' => [
                    'type' => 'Bearer',
                    'token' => $customer->createToken('Customer AccessToken')->plainTextToken
                ]
            ]
        );
    } 
}

?>