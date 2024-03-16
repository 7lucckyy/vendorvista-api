<?php

namespace App\Http\Controllers\Api\Product\V1\Fetch;

use App\Actions\ProductActions;
use App\Actions\StoreActions;
use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;

class VendorDashboardProductsController extends Controller
{
    public function __construct(
        private ProductActions $productActions,
        private StoreActions $storeActions
    ) {
    }

    public function handle()
    {
        $id = auth()->id();

        $store = $this->storeActions->getStoreById($id);

        $store_id = $store->id;

        $relationships = [
            'product_images',
        ];

        $products = $this->productActions->getAllProductRecordsByStore($store_id, $relationships);

        if (is_null($products)) {
            throw new NotFoundException('Store has no products available yet');
        }

        return successResponse('Store Products Fetched Successfully', 200, [
            'products' => $products,
        ]);
    }
}
