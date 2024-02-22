<?php

namespace App\Http\Controllers\Api\Product\V1\Fetch;

use App\Actions\ProductActions;
use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Product\V1\Fetch\FetchProductByStoreRequest;

class GetProductByStoreController extends Controller
{
    public function __construct(
        private ProductActions $productActions
    )
    {

    }

    public function handle(FetchProductByStoreRequest $request)
    {
        $store_id =  $request['id'];

        $relationships = [
            'product_images'
        ];


        $products = $this->productActions->getAllProductRecordsByStore($store_id, $relationships);
        
        if(is_null($products))
        {
            throw new NotFoundException('Store has no products available yet');
        }

        return successResponse('Store Products Fetched Successfully', 200, [
            'products' => $products
        ]);
    }
}