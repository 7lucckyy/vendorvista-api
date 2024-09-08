<?php


namespace App\Http\Controllers\Api\Address\Create;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Actions\CustomerAddressActions;
use App\Http\Requests\Api\Address\V1\CreateAddress\CreateAddressRequest;

class CreateUserCurrentAddress extends Controller  
{
    public function __construct(
        private CustomerAddressActions $customerAddressActions,
    ){}

    public function handle(CreateAddressRequest $createAddressRequest)
    {
        $userID = auth()->id();

        $validatedRequest = $createAddressRequest;

        $userAddress = $this->customerAddressActions->getCurrentAddressRecord($userID);
        DB::transaction( function () use($userID, $validatedRequest, $userAddress){
            if(!empty($userAddress))
            {
                $this->customerAddressActions->updateCurrentAddressRecord([
                    'customer_id' => $userID,
                    'updated_payload' => 
                        [
                            'is_current_address' => false
                        ]
                ]);
            }
            
            $this->customerAddressActions->createCurrentAddressRecord([
                    'create_payload' => [
                        'customer_id' => $userID,
                        'latitude' => $validatedRequest['latitude'],
                        'longitude' => $validatedRequest['longitude'],
                        'is_current_address' => true
                    ],
                ]);
        });

        return successResponse('Current Address updated successfully', 200);
    }
}