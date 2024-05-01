<?php


namespace App\Http\Controllers\Api\Artisan\V1\Activation;

use cloudinary;
use App\Actions\ArtisanActions;
use App\Actions\CustomerActions;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Artisan\V1\Activation\AccountActivationRequest;

class AccountActivationController extends Controller
{
    public function __construct(
        private ArtisanActions $artisanActions,
        private CustomerActions $customerActions,
    ){}

    public function handle(AccountActivationRequest $request)
    {
        $userId = auth()->id();

        $validatedRequest = $request->validated();

        $artisan = $this->customerActions->getCustomerByID($userId);

        $artisanId = $artisan->id;

        $profileImg =  cloudinary()->upload($request->file('profile_img')->getRealPath())->getSecurePath();
        DB::transaction(function () use ($validatedRequest, $artisanId, $profileImg) {
            $customer = $this->artisanActions->createArtisanRecord([
                'create_payload' => [
                    'service' => $validatedRequest['service'],
                    'about' => $validatedRequest['about'],
                    'img_path' => $profileImg,
                    'address' => $validatedRequest['address'],
                    'customer_id' => $artisanId,
                ],
            ]);
        });

        return successResponse('Artisan account activated successfully',200 );
    } 
}