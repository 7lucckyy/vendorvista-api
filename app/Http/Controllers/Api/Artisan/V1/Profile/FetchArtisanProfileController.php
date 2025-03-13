<?php

namespace App\Http\Controllers\Api\Artisan\V1\Profile;

use App\Actions\CustomerActions;
use App\Http\Controllers\Controller;
use App\Actions\CustomerAddressActions;
use Illuminate\Validation\UnauthorizedException;

class FetchArtisanProfileController extends Controller
{
    public function __construct(
        private CustomerActions $customerActions,
        private CustomerAddressActions $customerAddressActions,
    ){}
    
    public function handle()
    {
        
        $user = auth()->user();

        $userId = $user->id;

        $artisanId = $userId;

        if ($user->user_type !== 'artisan') {
            throw new UnauthorizedException('Access Denied', 403);
        }

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