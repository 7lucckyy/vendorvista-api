<?php

namespace App\Http\Controllers\Api\Cart\V1\Create;

use App\Actions\CartActions;
use App\Actions\ProductActions;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Exceptions\OutOfStockException;
use App\Http\Requests\Api\Product\V1\Fetch\FetchProductByStoreRequest;

class AddProductToCartController extends Controller
{
    public function __construct(
        private CartActions $cartActions,
        private ProductActions $productActions
    ){}

  
    public function handle(FetchProductByStoreRequest $request)
    {
        $userId = auth()->id();
        
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

        DB::transaction(function () use ($productId, $userId, $productQuantity) {
            $customer = $this->cartActions->createCartItemRecord([
                'create_cart_payload' => [
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'quantity' => $productQuantity
                ],
            ]);
        });

        return successResponse('Product added to cart successfully', 200);
    }
}