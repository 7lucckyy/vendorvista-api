<?php

namespace App\Http\Controllers\Api\Artisan\V1\Profile;

use App\Actions\CustomerActions;
use App\Actions\CustomerAddressActions;
use App\Actions\Auth\ArtisanAccessActions;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class FetchArtisanProfileController extends Controller
{
    public function __construct(
        private CustomerActions $customerActions,
        private CustomerAddressActions $customerAddressActions,
        private ArtisanAccessActions $ArtisanAccessAction
    ) {}

    public function handle(): JsonResponse
    {
        $user = auth()->user();

        // Validate Artisan access using Action
        $this->ArtisanAccessAction->execute($user);

        // Fetch artisan profile with relationships
        $artisanProfile = $this->customerActions->getCustomerByID($user->id, ['artisan', 'artisan.gallery']);
        
        // Fetch artisan address
        $artisanAddress = $this->customerAddressActions->getCurrentAddressRecord($user->id);

        // Safely decode skills and proficiency
        $artisanSkills = $artisanProfile->artisan->skills_and_proficiency 
            ? json_decode($artisanProfile->artisan->skills_and_proficiency, true) 
            : [];

        return successResponse('Artisan Profile Fetched Successfully', 200, [
            'artisan_profile' => $artisanProfile,
            'artisan_address' => $artisanAddress,
            'artisan_skills' => $artisanSkills,
        ]);
    }
}
