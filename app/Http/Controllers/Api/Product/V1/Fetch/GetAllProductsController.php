<?php

namespace App\Http\Controllers\Api\Product\V1\Fetch;

use App\Actions\ProductActions;
use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;

class GetAllProductsController extends Controller
{
    public function __construct(
        private ProductActions $productActions,
    ) {
    }

    public function handle()
    {
        $relationships =
        [
            'product_images',
        ];

        $products = $this->productActions->getAllProduct($relationships);

        if (is_null($products)) {
            throw new NotFoundException('No product records found');
        }

        return successResponse(
            'Products Fetched Successfully',
            200,
            [
                'products' => $products,
            ]
        );
    }
}
