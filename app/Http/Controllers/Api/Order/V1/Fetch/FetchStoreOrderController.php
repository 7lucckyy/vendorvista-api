<?php


namespace App\Http\Controllers\Api\Order\V1\Fetch;

use App\Actions\OrderActions;
use App\Actions\StoreActions;
use App\Http\Controllers\Controller;


class FetchStoreOrderController extends Controller 
{
    public function __construct(
        private StoreActions $storeActions,
        private OrderActions $orderActions
    ){}

    public function handle()
    {   
        $vendorId = auth()->id();

        $store = $this->storeActions->getStoreById($vendorId);

        $storeId = $store['id'];
        
        $relationships = ['product.product_images'];

        $order = $this->orderActions->getAllOrderByStore($storeId, $relationships);

       return  successResponse('Order fetched successfully', 200, $order);
    }
}