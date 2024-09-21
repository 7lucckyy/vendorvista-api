<?php

namespace App\Http\Controllers\Api\Order\V1\Fetch;

use App\Actions\OrderActions;
use App\Actions\StoreActions;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FetchStoreOrderController extends Controller 
{
    public function __construct(
        private StoreActions $storeActions,
        private OrderActions $orderActions
    ) {}

    public function handle(Request $request)
    {   
        $vendorId = auth()->id();
        $status = $request->get('status');

        if (empty($status)) {
            return errorResponse('Kindly provide order status', 400);
        }

        $store = $this->storeActions->getStoreById($vendorId);

        if (!$store) {
            return errorResponse('Store not found', 404);
        }

        $storeId = $store['id'];
        $relationships = ['product.product_images', 'customer'];
        
        $orders = $this->orderActions->getAllOrderByStore($storeId, $status, $relationships);

        if ($orders->isEmpty()) {
            return successResponse('No orders found with the provided status');
        }

        return successResponse('Orders fetched successfully', 200, $orders);
    }
}
