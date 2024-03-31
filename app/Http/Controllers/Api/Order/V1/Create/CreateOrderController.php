<?php


namespace App\Http\Controllers\Api\Order\V1\Create;
use App\Actions\OrderActions;
use App\Actions\ProductActions;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use App\Exceptions\OutOfStockException;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Api\Order\V1\Create\CreateNewOrderRequest;

class CreateOrderController extends Controller
{
    public function __construct(
        private OrderActions $orderActions,
        private ProductActions $productActions,
    ) {}

    public function handle(CreateNewOrderRequest $request): JsonResponse
    {
        $customerId = auth()->id();
        $email = auth()->user()->email_address;

        $validatedRequest = $request->validated();

        $productId = $validatedRequest['id'];
        $productQuantity = $validatedRequest['quantity'];

        $relationships = ['store'];

        $checkProductAvailabilityRecordOptions = [
            'id' => $productId,
            'quantity' => $productQuantity
        ];

        $checkOrderQuantityAvailability = $this->productActions
            ->checkProductAvailabilityRecord($checkProductAvailabilityRecordOptions, $relationships);

        if (!$checkOrderQuantityAvailability) {
            throw new OutOfStockException('Out of stock. Please reduce your quantity and try ordering again.');
        }

        $storeId = $checkOrderQuantityAvailability->store->id;
        $price = $validatedRequest['price'] * 100 * $productQuantity;
        $reference = paystack()->genTranxRef();

        $data = [
            'customer_id' => $customerId,
            'product_id' => $productId,
            'amount' => $price,
            'email' => $email,
            'reference' => $reference,
            'quantity' => $productQuantity,
            'delivery_status' => 0,
            'currency' => 'NGN',
            'store_id' => $storeId
        ];

        $paymentData = paystack()->getAuthorizationUrl($data)->url;

        return $this->createOrderTransaction($customerId, $productId, $price, $reference, $productQuantity, $paymentData, $storeId);
    }

    private function createOrderTransaction(string $customerId, string $productId, int $price, string $reference, int $productQuantity, string $paymentData, string $storeId): JsonResponse
    {
        return DB::transaction(function () use ($customerId, $productId, $price, $reference, $productQuantity, $paymentData, $storeId) {
            $order = $this->orderActions->createOrderRecord([
                'create_order_payload' => [
                    'customer_id' => $customerId,
                    'product_id' => $productId,
                    'price' => $price,
                    'store_id' => $storeId,
                    'reference' => $reference,
                    'quantity' => $productQuantity,
                    'delivery_status' => 0,
                    'payment_url' => $paymentData,
                ]
            ]);

            return response()->json(['message' => 'Order placed successfully', 'data' => $order], 200);
        });
    }
}
