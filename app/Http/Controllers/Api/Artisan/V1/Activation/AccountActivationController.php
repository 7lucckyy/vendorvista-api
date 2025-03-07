<?php


namespace App\Http\Controllers\Api\Artisan\V1\Activation;

use App\Actions\ArtisanActions;
use App\Actions\CustomerActions;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Actions\CustomerAddressActions;
use App\Http\Requests\Api\Artisan\V1\Activation\AccountActivationRequest;
use App\Http\Requests\Api\Artisan\V1\Activation\ActivateArtisanAccountRequest;

class AccountActivationController extends Controller
{
    public function __construct(
        private ArtisanActions $artisanActions,
        private CustomerActions $customerActions,
        private CustomerAddressActions $customerAddressActions,

    ){}

    public function handle(ActivateArtisanAccountRequest $request)
    {
        $userId = auth()->id();

        $validatedRequest = $request->validated();

        $artisan = $this->customerActions->getCustomerByID($userId);

        $artisanId = $artisan->id;

        DB::transaction(function () use ($validatedRequest, $artisanId) {
            $this->artisanActions->createArtisanRecord([
                'create_payload' => [
                    'service' => $validatedRequest['service'],
                    'about' => $validatedRequest['about'],
                    'whatsapp_number' => $validatedRequest['whatsapp_number'],
                    'img_path' => $validatedRequest['img_path'],
                    'is_active' => true,
                    'customer_id' => $artisanId,
                ],
            ]);
            $this->customerActions->updateCustomerRecord([
                'customer_id' => $artisanId,
                'update_payload' => [
                    'address' => $validatedRequest['address'],
                    'nin_number' => $validatedRequest['nin_number'],
                ],
            ]);

            $this->customerAddressActions->createCurrentAddressRecord([
                'create_payload' => [
                    'customer_id' => $artisanId,
                    'latitude' => $validatedRequest['latitude'],
                    'longitude' => $validatedRequest['longitude'],
                    'is_current_address' => true
                ],
            ]);
        });

        return successResponse('Artisan account activated successfully',200 );
    } 
}