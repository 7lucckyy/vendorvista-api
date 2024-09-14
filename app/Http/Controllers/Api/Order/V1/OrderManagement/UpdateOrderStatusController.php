<?php

namespace App\Http\Controllers\Api\Order\V1\OrderManagement;

use App\Actions\OrderActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Order\V1\Update\UpdateOrderStatusRequest;

class UpdateOrderStatusController extends Controller
{
    public function __construct(
        private OrderActions $orderActions,
    ){}

    public function handle(UpdateOrderStatusRequest $updateOrderStatusRequest)
    {
        $requestValidated = $updateOrderStatusRequest->validated();
        $order_id = $requestValidated['order_id'];
        $order_status = $requestValidated['order_status'];

        $order = $this->orderActions->getOrderByID($order_id);

        $this->orderActions->updateOrderStatusById([
            'order_id' => $order->id,
            'update_order_payload' => [
                'order_status' => $order_status
            ]
        ]);

        return successResponse('Order Status updated successfully', 200);
    }
}