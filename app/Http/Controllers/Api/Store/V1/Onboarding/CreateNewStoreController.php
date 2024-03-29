<?php

namespace App\Http\Controllers\Api\Store\V1\Onboarding;

use App\Actions\StoreActions;
use App\Actions\VendorActions;
use App\Exceptions\AlreadyExistException;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Exceptions\NotFoundException;
use App\Http\Requests\Api\Store\V1\Onboarding\CreateStoreRequest;

class CreateNewStoreController extends Controller 
{
    public function __construct(
       private StoreActions $storeActions,
    )
    {

    }

    public function handle(CreateStoreRequest $request){
        $vendorId = auth()->id();

        $validatedRequest = $request->validated();

        $relationships = [
            'vendor'
        ];

        $vendor = $this->storeActions->getStoreById(
            id : $vendorId,
            relationships: $relationships
            
        );

        if($vendor)
        {
            throw new AlreadyExistException('Vendor Already has Store', 400);
        }

        DB::transaction(function () use($validatedRequest, $vendorId) {
            $store = $this->storeActions->createStoreRecord([
               'store_payload' => [
                    'store_name' => $validatedRequest['store_name'],
                    'business_type' => $validatedRequest['business_type'],
                    'is_registered' => $validatedRequest['is_registered'],
                    'cac_number' => $validatedRequest['cac_number'],
                    'business_address' => $validatedRequest['business_address'],
                    'vendor_id' => $vendorId
    
               ],
            ]);
            
            
        });
        return successResponse(
            'Store record was created successfully',
            201,
        );

    }
}