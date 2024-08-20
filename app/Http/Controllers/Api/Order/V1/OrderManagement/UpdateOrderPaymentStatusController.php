<?php


namespace App\Http\Controllers\Api\Order\V1\OrderManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\OrderActions;
use App\Actions\ProductActions;
use Illuminate\Support\Facades\Log;

class UpdateOrderPaymentStatusController extends Controller
{
    public function __construct(
        private ProductActions $productActions,
        private OrderActions $orderActions
    ){
        
    }
    public function handle(Request $request)
    {     // Verify the webhook signature
            if (!$this->verifyWebhookSignature($request)) {
                return response()->json(['status' => 'error', 'message' => 'Invalid signature'], 400);
            }
    
            // Process the webhook payload
            $payload = $request->all();

            dd($payload);
    
            // Handle different event types
            switch ($payload['event']) {
                case 'charge.success':
                    $this->handleSuccessfulCharge($payload['data']);
                    break;
                // Add more cases for other event types as needed
                default:
                    Log::info('Unhandled Paystack webhook event: ' . $payload['event']);
            }
    
            return response()->json(['status' => 'success']);
        }
    
        private function verifyWebhookSignature(Request $request)
        {
            $paystackSecret = config('services.paystack.secret_key');
            $signature = $request->header('x-paystack-signature');
            $computedSignature = hash_hmac('sha512', $request->getContent(), $paystackSecret);
    
            return hash_equals($signature, $computedSignature);
        }
    
        private function handleSuccessfulCharge($data)
        {
            // Implement your logic to handle successful charges
            // For example, update order status, send confirmation email, etc.
            Log::info('Successful charge: ' . json_encode($data));
        }
    
        // Retrieve payment data
        // $paymentData = paystack()->getPaymentData();
        
        // // Check if payment status is true
        // if ($paymentData['status'] === true) 
        // {
        //     // Extract order reference ID
        //     $paymentDetails = $paymentData['data'];

        //     $orderReference = $paymentDetails['reference'];

        //     $relationships = [
        //         'product'
        //     ];

        //     $productId = $this->orderActions->getOrderByRefID($orderReference, $relationships);

        //     DB::transaction(function () use ($orderReference, $productId) {
        //         $this->orderActions->updateOrderStatus([
        //             'reference' => $orderReference,
        //             'update_order_payload' => [
        //                 'is_paid' => true,
        //             ],
        //         ]);

        //         $this->productActions->incrementTotalOrder($productId);
        //         $this->productActions->decrementQuantity($productId);
        //     });
        
        //    return successResponse('Order Payment Status Updated Successfully', 200);
            
        // }  
        
}