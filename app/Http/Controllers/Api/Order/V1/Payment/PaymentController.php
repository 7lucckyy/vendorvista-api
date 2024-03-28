<?php

namespace App\Http\Controllers\Api\Order\V1\Payment;

use App\Http\Controllers\Controller;
use Unicodeveloper\Paystack\Facades\Paystack;

class PaymentController extends Controller
{
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        dd($paymentDetails);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }
}