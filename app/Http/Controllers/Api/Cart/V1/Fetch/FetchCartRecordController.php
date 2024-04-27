<?php 


namespace App\Http\Controllers\Api\Cart\V1\Fetch;

use App\Actions\CartActions;
use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;

class FetchCartRecordController extends Controller
{
    public function __construct(
        private CartActions $cartActions
    ){}

    public function handle()
    {
        $userId = auth()->id();

        $relationships = [
            'product.product_images'
        ];

        $cartRecords = $this->cartActions->getCartItemsRecord($userId, $relationships);

        if(is_null($cartRecords)){
            throw new NotFoundException('No Product yet on cart kindly add one now', 200);
        }

        return successResponse('Cart Products fetched successfully', 200, $cartRecords);
    }
}