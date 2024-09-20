<?php

namespace App\Http\Controllers\Api\Order\V1\OrderManagement;

use App\Actions\OrderActions;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Order\V1\Update\UpdateOrderStatusRequest;

class UpdateOrderStatusController extends Controller
{
    public function __construct(
        private OrderActions $orderActions,
    ){}

    public function handle(UpdateOrderStatusRequest $request)
    {
               
        $order_id = $request['order_id'];
        $order_status = $request['order_status'];

        
        DB::transaction(function () use ($order_id, $order_status) {
            $this->orderActions->updateOrderStatusById([
                'order_id' => $order_id,
                'update_order_payload' => [
                    'status' => $order_status
                ]
            ]);
        });             
    
        return successResponse('Order Status updated successfully', 200);
    }
}