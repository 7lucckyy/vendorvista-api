<?php

namespace App\Http\Controllers\Api\Order\V1\Fetch;

use App\Actions\OrderActions;
use App\Http\Controllers\Controller;

class FetchCustomerUnpaidOrderRecordController extends Controller
{
    public function __construct(
        private OrderActions $orderActions,

    )
    {}

    public function handle()
    {
        $customerId = auth()->id();

        $relationships = ['product.product_images'];

        $order = $this->orderActions->getAllOrderByCustomer($customerId, $relationships);

       return  successResponse('Order fetched successfully', 200, $order);
    }
}