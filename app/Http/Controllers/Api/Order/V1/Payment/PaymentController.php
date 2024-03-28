<?php

namespace App\Http\Controllers\Api\Order\V1\Payment;

use App\Http\Controllers\Controller;
use Unicodeveloper\Paystack\Facades\Paystack;

class PaymentController extends Controller
{
    public function handle(){

        $data = array(
            "amount" => 700 * 100,
            "reference" => paystack()->genTranxRef(),
            "email" => 'user@mail.com',
            "currency" => "NGN",
            "orderID" => 23456,
        );
    

        $url = paystack()->getAuthorizationUrl($data)->url;
        dd($url);
    }  
}