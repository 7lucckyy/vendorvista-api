<?php

namespace App\Http\Controllers\Api\Product\V1\Fetch;

use App\Actions\ProductActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Product\V1\Fetch\SearchProductRequest;

class SearchProductController extends Controller
{
    public function __construct(
        private ProductActions $productActions,
    ){}

    public function handle(SearchProductRequest $searchProductRequest)
    {
        $relationships = ['product_images', 'product_variants', 'store'];

        $search = $searchProductRequest['search'];

        $products = $this->productActions->searchProductRecord([
            'search_payload'=> [
                'search' => $search,
                'relationships' => $relationships
            ]
        ]);

        return successResponse('Product Fetched Successfully', 200, $products);

    }
}