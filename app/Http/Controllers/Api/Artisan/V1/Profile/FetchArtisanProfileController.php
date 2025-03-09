<?php

namespace App\Http\Controllers\Api\Artisan\V1\Profile;

use App\Actions\CustomerActions;
use App\Http\Controllers\Controller;
use App\Actions\CustomerAddressActions;

class FetchArtisanProfileController extends Controller
{
    public function __construct(
        private CustomerActions $customerActions,
        private CustomerAddressActions $customerAddressActions,
    ){}
    
    public function handle()
    {
        $userId = auth()->id();

        $artisanId = $userId;

        $artisanProfile = $this->customerActions->getCustomerByID($artisanId, ['artisan', 'artisan.gallery']);

        $artisanAddress = $this->customerAddressActions->getCurrentAddressRecord($artisanId);
        $artisanSkill = json_decode($artisanProfile->artisan->skills_and_proficiency);
        return successResponse('Artisan Profile Fetch Successfully', 200, [
            'artisan_profile' => $artisanProfile,
            'artisan_address' => $artisanAddress,
            'artisan_skill' => $artisanSkill,
        ]);
    }
}