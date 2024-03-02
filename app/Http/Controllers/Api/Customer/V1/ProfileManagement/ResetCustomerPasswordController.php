<?php

namespace App\Http\Controllers\Api\Customer\V1\ProfileManagement;
use App\Actions\CustomerActions;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Exceptions\NotFoundException;
use App\Http\Requests\Api\Customer\V1\Authentication\ResetCustomerPasswordRequest;
use Illuminate\Support\Facades\Hash;

class ResetCustomerPasswordController extends Controller
{

    public function __construct(
        private CustomerActions $customerActions,
        
    )
    {

    }
    public function handle(ResetCustomerPasswordRequest $request)

    {

        $validatedRequest = $request->validated();

        $customer = $this->customerActions->getCustomerByEmail(
            $request->email_address
        );
    
        if (is_null($customer))
        {
            throw new NotFoundException('Customer record does not exist');
    
        }

        $this->customerActions->updateCustomerRecord([
            'update_payload' => [
                'entity_id' => $customer->id
            ]
        ]);
        
        return successResponse(
            'Customer record was updated successfully',
            201,
        );
        
    }
}