<?php

namespace App\Http\Controllers\Api\Cart\V1\Create;

use App\Actions\CartActions;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Api\Product\V1\Fetch\FetchProductByStoreRequest;

class AddProductToCartController extends Controller
{
    public function __construct(
        private CartActions $cartActions,
    ){}

    public function handle(FetchProductByStoreRequest $request)
    {
        $userId = auth()->id();
        
        $validatedRequest = $request->validated();

        DB::transaction(function () use ($validatedRequest, $userId) {
            $customer = $this->cartActions->createCartItemRecord([
                'create_cart_payload' => [
                    'user_id' => $userId,
                    'product_id' => $validatedRequest['id'],
                    'quantity' => 1
                ],
            ]);
        });

        return successResponse('Product added to cart successfully', 200);
    }
}