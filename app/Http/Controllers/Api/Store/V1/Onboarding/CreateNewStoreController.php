<?php

namespace App\Http\Controllers\Api\Store\V1\Onboarding;

use App\Actions\StoreActions;
use App\Exceptions\AlreadyExistException;
use App\Exceptions\UnAuthorizedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Store\V1\Onboarding\CreateStoreRequest;
use Illuminate\Support\Facades\DB;

class CreateNewStoreController extends Controller
{
    public function __construct(
       private StoreActions $storeActions,
    ) {
    }

    public function handle(CreateStoreRequest $request)
    {
        $vendorId = auth()->id();
        if (auth()->user()->user_type !== 'vendor') {
            throw new UnAuthorizedException('Access Denied', 403);
        }

        $validatedRequest = $request->validated();

        $relationships = [
            'customer',
        ];

        $vendor = $this->storeActions->getStoreById(
            id : $vendorId,
            relationships: $relationships

        );

        if ($vendor) {
            throw new AlreadyExistException('Vendor Already has Store', 400);
        }

        DB::transaction(function () use ($validatedRequest, $vendorId) {
            $store = $this->storeActions->createStoreRecord([
                'store_payload' => [
                    'store_name' => $validatedRequest['store_name'],
                    'is_registered' => $validatedRequest['is_registered'],
                    'cac_number' => $validatedRequest['cac_number'],
                    'business_address' => $validatedRequest['business_address'],
                    'customer_id' => $vendorId,
                ],
            ]);
        });

        return successResponse(
            'Store record was created successfully',
            201,
        );
    }
}
