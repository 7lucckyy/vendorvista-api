<?php

namespace App\Http\Controllers\Api\Product\V1\Fetch;

use App\Actions\ProductActions;
use App\Http\Controllers\Controller;

class GetProductByStoreController extends Controller
{
    public function __construct(
        private ProductActions $productActions
    )
    {

    }

    public function handle()
    {

        $relationships = [
            'product_images'
        ];

        $products = $this->productActions->getAllProductRecordsByStore($store_id, $relationships);
        
    }
}