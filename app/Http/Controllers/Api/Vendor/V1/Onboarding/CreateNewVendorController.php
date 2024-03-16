<?php

namespace App\Http\Controllers\Api\Vendor\V1\Onboarding;

use App\Actions\VendorActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Vendor\V1\Onboarding\CreateVendorRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateNewVendorController extends Controller
{
    public function __construct(
       private VendorActions $vendorActions
    ) {
    }

    public function handle(CreateVendorRequest $request)
    {
        $validatedRequest = $request->validated();

        DB::transaction(function () use ($validatedRequest) {
            $vendor = $this->vendorActions->createVendorRecord([
                'vendor_payload' => [
                    'first_name' => $validatedRequest['first_name'],
                    'last_name' => $validatedRequest['last_name'],
                    'phone_number' => $validatedRequest['phone_number'],
                    'email_address' => $validatedRequest['email_address'],
                    'password' => Hash::make($validatedRequest['password']),
                    'nin_number' => $validatedRequest['nin_number'],
                    'address' => $validatedRequest['address'],
                ],
            ]);
        });

        return successResponse(
            'Vendor record was created successfully',
            201,
        );
    }
}
