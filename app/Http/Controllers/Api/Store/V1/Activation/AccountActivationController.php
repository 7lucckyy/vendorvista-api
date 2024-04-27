<?php

namespace App\Http\Controllers\Api\Store\V1\Activation;

use Cloudinary;
use App\Actions\StoreActions;
use App\Actions\CustomerActions;
use Illuminate\Support\Facades\DB;
use App\Actions\BankDetailsActions;
use App\Http\Controllers\Controller;
use App\Exceptions\UnAuthorizedException;
use App\Http\Requests\Api\Vendor\V1\Activation\AccountActivationRequest;


class AccountActivationController extends Controller
{
    public function __construct(
       private StoreActions $storeActions,
       private CustomerActions $customerActions,
       private BankDetailsActions $bankDetailsActions,
    ) 
    {
    }

    public function handle(AccountActivationRequest $request)
    {
         // Get the authenticated user's ID and check if they are a vendor
        $vendorId = auth()->id();

        $user = auth()->user();

        if ($user->user_type !== 'vendor') {
            throw new UnauthorizedException('Access Denied', 403);
        }

        $validatedRequest = $request->validated();

        $relationships = [
            'customer',
        ];

        // Retrieve vendor details including customer information
        $vendor = $this->storeActions->getStoreById(
            id : $vendorId,
            relationships: $relationships

        );

        $storeId = $vendor->id;

        $customerId = $vendor->customer_id;

        // Upload CAC certificate if provided
        $cacCertificatePath = '';
        if ($request->hasFile('cac_certificate')) {
            $image = $request->file('cac_certificate');
            $cacCertificatePath = Cloudinary::upload($image->getRealPath())->getSecurePath();
        }

         // Update store and customer records within a transaction
        DB::transaction(function () use ($validatedRequest, $storeId, $customerId,  $cacCertificatePath) {
             // Update store record
            $store = $this->storeActions->updateStoreRecord([
                'store_id' => $storeId,
                'update_payload' => [
                    'is_registered' => $validatedRequest['is_registered'],
                    'cac_number' => $validatedRequest['cac_number'] ?? '',
                    'business_address' => $validatedRequest['address'],
                    'cac_certificate_path' => $cacCertificatePath
                ],
            ]);

            // Update customer record
            $this->customerActions->updateCustomerRecord([
                'entity_id' => $customerId,
                'update_payload' => [
                    'full_name' => $validatedRequest['account_name'],
                    'phone_number' => $validatedRequest['phone_number'],
                ],
            ]);
        });

        // Create bank account details record
        $this->bankDetailsActions->createAccountDetailsRecord([
            'create_payload' => [
                'store_id' => $storeId,
                'bank_name' => $validatedRequest['bank_name'],
                'account_name' => $validatedRequest['account_name'],
                'account_number' => $validatedRequest['account_number'],
            ]
            ]);

        return successResponse(
            'Store activation request was sent successfully',
            200,
        );
    }
}
