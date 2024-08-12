<?php


namespace App\Http\Controllers\Api\Order\V1\OrderManagement;

use App\Actions\OrderActions;
use App\Actions\ProductActions;
use Illuminate\Http\Request;

class UpdateOrderPaymentStatusController 
{
    public function __construct(
        private ProductActions $productActions,
        private OrderActions $orderActions
    ){
        
    }
    public function handle(Request $request)
    {
        $event = $request->event;
        
        return dd($event);
        // Retrieve payment data
        $paymentData = paystack()->getPaymentData();
        
        // Check if payment status is true
        if ($paymentData['status'] === true) 
        {
            // Extract order reference ID
            $paymentDetails = $paymentData['data'];

            $orderReference = $paymentDetails['reference'];

            $relationships = [
                'product'
            ];

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
        
           return successResponse('Order Payment Status Updated Successfully', 200);
            
        }  
    }      
}