<?php

namespace App\Http\Controllers\Api\Product\V1\Fetch;

use App\Actions\ProductActions;
use App\Exceptions\NotFoundException;
use Illuminate\Http\JsonResponse;

class HomeDashboardController 
{
    private ProductActions $productActions;

    public function __construct(ProductActions $productActions)
    {
        $this->productActions = $productActions;
    }

    public function handle(): JsonResponse
    {
        $relationships = ['product_images', 'store', 'product_ratings'];

        $hotSalesProducts = $this->fetchProductRecords('getHotSalesRecord', ['limit' => 6], $relationships);
        $latestProducts = $this->fetchProductRecords('getLatestProductRecord', ['limit' => 6], $relationships);
        $mostLikedProducts = $this->fetchProductRecords('getMostLikedProductRecord', ['limit' => 6], $relationships);

        $data = [
            'hotSalesProducts' => $hotSalesProducts,
            'latestProducts' => $latestProducts,
            'mostLikedProducts' => $mostLikedProducts
        ];

        return successResponse('Products Fetched Successfully', 200, ['products' => $data]);
    }

    private function fetchProductRecords(string $method, array $options, array $relationships)
    {
        $products = $this->productActions->$method($options, $relationships);

        if ($products->isEmpty()) {
            throw new NotFoundException('No product records found');
        }

        return $products;
    }
}
