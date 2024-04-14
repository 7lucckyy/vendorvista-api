<?php

namespace App\Http\Controllers\Api\Product\V1\Fetch;

use App\Actions\ProductActions;
use App\Exceptions\NotFoundException;

class GetLatestProductsController
{
    public function __construct(
        private ProductActions $productActions
    ) {
    }

    public function handle()
    {
        $relationships =
        [
            'product_images',
        ];

        $getLatestProductRecordsOptions =
        [
            'limit' => 6,
        ];

        $products = $this->productActions->getLatestProductRecord($getLatestProductRecordsOptions, $relationships);

        if ($products->isEmpty()) {
            throw new NotFoundException('No product records found');
        }

        return successResponse(
            'Latest Products Fetched Successfully',
            200,
            [
                'products' => $products,
            ]
        );
    }
}
