<?php


namespace App\Http\Controllers\Api\Artisan\V1\Activation;

use App\Actions\ArtisanActions;
use App\Actions\CustomerActions;
use App\Http\Controllers\Controller;


class AccountActivationController extends Controller
{
    public function __construct(
        private ArtisanActions $artisanActions,
        private CustomerActions $customerActions,
    ){}

    public function handle()
    {
        
    }
}