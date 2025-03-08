<?php

namespace App\Http\Controllers\Api\Artisan\V1\Fetch;

use App\Actions\ArtisanActions;
use App\Actions\CustomerActions;
use App\Http\Controllers\Controller;
use App\Actions\CustomerAddressActions;

class FetchAllArtisansController extends Controller
{
    public function __construct(
        private ArtisanActions $artisanActions,
        private CustomerActions $customerActions,
        private CustomerAddressActions $customerAddressActions,

    )
    {
    }

    public function handle()
    {
        $artisans = $this->customerActions->getAllCustomers('artisan');

        $artisansData = [];

        foreach ($artisans as $artisan) 
        {
            $artisanProfile = $this->customerActions->getCustomerByID($artisan->id, 'artisan');
            $artisanAddress = $this->customerAddressActions->getCurrentAddressRecord($artisan->id);
            $artisanSkill = json_decode($artisanProfile->artisan->skills_and_proficiency);
            $artisansData[] = [
                'artisan_profile' => $artisanProfile,
                'artisan_address' => $artisanAddress,
                'artisan_skill' => $artisanSkill,
            ];
        }

        return successResponse('Artisans Fetch Successfully', 200, [
            'artisans' => $artisansData,
        ]);
    }
}