<?php


namespace App\Http\Controllers\Api\Order\V1\OrderManagement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CallbackPaystackController extends Controller
{
    public function handle(Request $request)
    {
        // Retrieve payment data
        $paymentData = paystack()->getPaymentData();

        try {
            
            if ($paymentData['status'] !== 'success') {
                return errorResponse('Payment was not successful', 400);
            }

            return successResponse('Payment successful', 200);

        } catch (\Exception $e) {
            return errorResponse('Could not process payment', 500);
        }
    }

}