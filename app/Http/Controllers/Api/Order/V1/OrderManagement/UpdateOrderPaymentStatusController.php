<?php


namespace App\Http\Controllers\Api\Order\V1\OrderManagement;

use Illuminate\Http\Request;
use App\Actions\OrderActions;
use App\Actions\ProductActions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class UpdateOrderPaymentStatusController extends Controller
{
    public function __construct(
        private ProductActions $productActions,
        private OrderActions $orderActions
    ){
        
    }
    public function handle(Request $request)
    {     
         // Verify the Paystack signature
         if (!$this->verifyPaystackSignature($request)) 
         {
            return response()->json(['status' => 'error', 'message' => 'Invalid signature'], 401);
        }

        $payload = $request->all();

        // Check if the event is a charge.success
        if ($payload['event'] === 'charge.success') {
            $paymentData = $payload['data'];

            if ($paymentData['status'] === 'success') {
                $orderReference = $paymentData['reference'];

                $relationships = ['product'];

                try {
                    $productId = $this->orderActions->getOrderByRefID($orderReference, $relationships);

                    DB::transaction(function () use ($orderReference, $productId) {
                        $this->orderActions->updateOrderStatus([
                            'reference' => $orderReference,
                            'update_order_payload' => [
                                'is_paid' => true,
                            ],
                        ]);

                        $this->productActions->incrementTotalOrder($productId);
                        $this->productActions->decrementQuantity($productId);
                    });

                    Log::info("Order payment status updated for reference: {$orderReference}");
                    return successResponse('Order Payment Status Updated Successfully', 200);
                } catch (\Exception $e) {
                    Log::error("Error processing payment for order {$orderReference}: " . $e->getMessage());
                    return response()->json(['status' => 'error', 'message' => 'Error processing payment'], 500);
                }
            }
        }

        // For other event types or non-success status, just acknowledge receipt
        return response()->json(['status' => 'success', 'message' => 'Webhook received']);
    }

    private function verifyPaystackSignature(Request $request)
    {
        $paystackSecret = config('services.paystack.secret');
        $signature = $request->header('x-paystack-signature');
        $payload = $request->getContent();

        $computedSignature = hash_hmac('sha512', $payload, $paystackSecret);

        return hash_equals($signature, $computedSignature);
    }    
        
}