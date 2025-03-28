<?php


namespace App\Http\Controllers\Api\Artisan\V1\Activation;

use App\Actions\ArtisanActions;
use App\Actions\CustomerActions;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Actions\CustomerAddressActions;
use App\Exceptions\UnAuthorizedException;
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

        if($artisan->user_type !== 'artisan'){
            throw new UnauthorizedException('Access Denied', 403);
        }

        if($artisan->email_verified_at === null){
            throw new UnauthorizedException('Email not verified', 403);
        }
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
                    'skills_and_proficiency' => json_encode($validatedRequest['skills']),
                ],
            ]);
            $this->customerActions->updateCustomerRecord([
                'customer_id' => $artisanId,
                'update_payload' => [
                    'address' => $validatedRequest['address'],
                    'account_activated' => true,
                    'nin_number' => $validatedRequest['nin_number'],
                ],
            ]);

            $this->customerAddressActions->createCurrentAddressRecord([
                'create_payload' => [
                    'customer_id' => $artisanId,
                    'latitude' => $validatedRequest['latitude'],
                    'longitude' => $validatedRequest['longitude'],
                    'is_current_address' => true,
                    
                ],
            ]);
        });

        return successResponse('Artisan account activated successfully',200 );
    } 
}