<?php

namespace App\Actions;

use App\Models\Order;

class OrderActions
{
    public function __construct(
        private Order $order
    ) {
    }

    public function createOrderRecord($createOrderRecordOptions)
    {
        $data = $createOrderRecordOptions['create_order_payload'];

        return $this->order->create($data);
    }

    public function getOrderByID($entity_id, $relationships = [])
    {
        return $this->order->with($relationships)->where([
            'id' => $entity_id,
        ])->get();
    }

    public function getOrderByRefID($reference_id, $relationships = [])
    {
        return $this->order->with($relationships)->where([
            'reference' => $reference_id,
        ])->get()->first()->product_id;
    }

    public function getAllOrdersByPaymentStatus($payment_status, $relationships = [])
    {
        return $this->order->with($relationships)->where([
            'payment_status' => $payment_status,
        ])->get();
    }

    public function getAllOrderByCustomer($customer_id, $relationships = [])
    {
        return $this->order->with($relationships)->where([
            'customer_id' => $customer_id,
            'payment_status' => true,
        ])->get();
    }

    public function getAllOrderByStore($store_id, $relationships = [])
    {
        return $this->order->with($relationships)->where([
            'store_id' => $store_id,
            'payment_status' => true,
        ])->get();
    }

    public function updateOrderStatus($updateOrderRecordOptions)
    {
        $reference = $updateOrderRecordOptions['reference'];
        $data = $updateOrderRecordOptions['update_order_payload'];

        $this->order->where([
            'reference' => $reference
        ])->update($data);
    }

    public function deleteOrderRecord($deleteOrderRecordOptionsOptions)
    {
        $entity_id = $deleteOrderRecordOptionsOptions['id'];

        return $this->order->where([
            'id' => $entity_id,
        ])->delete();
    }
}
