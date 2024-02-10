<?php

namespace App\Http\Controllers\Api\Store\V1\Onboarding;

use App\Actions\StoreActions;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Store\V1\Onboarding\CreateStoreRequest;

class CreateNewStoreController extends Controller 
{
    public function __construct(
       private StoreActions $storeActions
    )
    {

    }

    public function handle(CreateStoreRequest $request){
        $vendorID = auth()->id();

        $validatedRequest = $request->validated();

        if (is_null($customer))
        {
            throw new NotFoundException('Customer record does not exist');

        }

        DB::transaction(function () use($validatedRequest, $vendorID) {
            $store = $this->storeActions->createStoreRecord([
               'store_payload' => [
                    'store_name' => $validatedRequest['store_name'],
                    'business_type' => $validatedRequest['business_type'],
                    'is_registered' => $validatedRequest['is_registered'],
                    'cac_number' => $validatedRequest['cac_number'],
                    'business_address' => $validatedRequest['business_address'],
                    'vendor_id' => $vendorID
    
               ],
            ]);
            
            
        });
        return successResponse(
            'Store record was created successfully',
            201,
        );

    }
}