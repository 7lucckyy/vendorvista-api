<?php

namespace App\Http\Controllers\Api\Store\V1\Activation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerifyAccountNumberController extends Controller
{
    public function handle(Request $request)
    {
        
        $code = $request['code'];
        $account_number = $request['account_number'];

        $data = paystack()->confirmAccount($account_number, $code);

        return successResponse('Account verified successfully', 200, $data);
    
    }
}