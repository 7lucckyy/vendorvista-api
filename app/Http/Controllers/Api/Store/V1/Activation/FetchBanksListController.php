<?php


namespace App\Http\Controllers\Api\Store\V1\Activation;

use App\Http\Controllers\Controller;

class FetchBanksListController extends Controller 
{
    public function handle()
    {
        $banksList = paystack()->getBanks('nigeria');

        return successResponse('Bank list fetched successfully', 200, $banksList);
    }
}