<?php

namespace App\Http\Controllers\Api\Cart\V1\Checkout;

use App\Actions\CartActions;
use Illuminate\Http\Request;
use App\Actions\OrderActions;
use App\Actions\ProductActions;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Exceptions\OutOfStockException;

class CartCheckoutController extends Controller 
{
    public function __construct(
        private OrderActions $orderActions,
        private ProductActions $productActions,
        private CartActions $cartActions
    ) {}

    public function handle(): JsonResponse
    {
        $customerId = auth()->id();
        $email = auth()->user()->email_address;

        $cartItems = $this->cartActions->getCartItemsRecord($customerId);

        if ($cartItems === []) {
            return errorResponse('Cart is empty');
        }

        $totalAmount = 0;
        $orderItems = [];

        $reference = paystack()->genTranxRef();

        foreach ($cartItems as $item) {
            $checkProductAvailabilityRecordOptions = [
                'id' => $item->product_id,
                'quantity' => $item->quantity
            ];

            $product = $this->productActions->checkProductAvailabilityRecord($checkProductAvailabilityRecordOptions, ['store']);

            if (!$product) {
                throw new OutOfStockException("Product {$item->product_id} is out of stock. Please update your cart.");
            }

            $itemAmount = $product->price * $item->quantity;
            $totalAmount += $itemAmount;

            $orderItems[] = [
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $product->price * $item->quantity,
                'store_id' => $product->store->id,
            ];
        }

        $data = [
            'customer_id' => $customerId,
            'amount' => $totalAmount * 100,
            'email' => $email,
            'reference' => $reference,
            'currency' => 'NGN',
        ];

        $paymentData = paystack()->getAuthorizationUrl($data)->url;

        return $this->createCartOrderTransaction($customerId, $orderItems, $totalAmount, $reference, $paymentData);
    }

    private function createCartOrderTransaction(string $customerId, array $orderItems, int $totalAmount, string $reference, string $paymentData): JsonResponse
    {
        return DB::transaction(function () use ($customerId, $orderItems, $totalAmount, $reference, $paymentData) {
            // Create individual orders for each store
            $orders = [];
            $groupedItems = $this->groupOrderItemsByStore($orderItems);

            foreach ($groupedItems as $storeId => $items) {
                $storeTotal = array_sum(array_column($items, 'price'));
                $order = $this->orderActions->createOrderRecord([
                    'create_order_payload' => [
                        'customer_id' => $customerId,
                        'price' => $storeTotal,
                        'reference' => $reference, // Unique reference per store
                        'product_id' => $items[0]['product_id'], // First product in the order
                        'store_id' => $storeId,
                        'delivery_status' => 'pending',
                        'payment_url' => $paymentData,
                        'quantity' => array_sum(array_column($items, 'quantity')),
                        'is_paid' => false,
                    ],
                    'order_items' => $items
                ]);
                $orders[] = $order;
            }

            return successResponse('Cart checkout successful', 200, [
                'orders' => $orders,
                'payment_url' => $paymentData
            ]);
        });
    }

    private function groupOrderItemsByStore(array $orderItems): array
    {
        $groupedItems = [];
        foreach ($orderItems as $item) {
            $storeId = $item['store_id'];
            if (!isset($groupedItems[$storeId])) {
                $groupedItems[$storeId] = [];
            }
            $groupedItems[$storeId][] = $item;
        }
        return $groupedItems;
    }
}