<?php

namespace App\Http\Controllers\Api\Product\V1\Fetch;

use Illuminate\Http\Request;
use App\Actions\ProductActions;
use App\Actions\StoreActions;
use App\Http\Controllers\Controller;
use App\Exceptions\NotFoundException;
use App\Http\Requests\Api\Product\V1\Fetch\FetchProductByStoreRequest;

class GetProductByStoreController extends Controller
{
    public function __construct(
        private ProductActions $productActions,
        private StoreActions $storeActions,
    ) {
    }

    public function handle(Request $request)
    {
        $userId = auth()->id();
        

        $relationships = [
            'product_images',
        ];

        $store = $this->storeActions->getStoreById($userId);
        $store_id = $store->id;

        $products = $this->productActions->getAllProductRecordsByStore($store_id, $relationships);

        if (is_null($products)) {
            throw new NotFoundException('Store has no products available yet');
        }

        return successResponse('Store Products Fetched Successfully', 200, [
            'products' => $products,
        ]);
    }
}
