<?php

namespace App\Http\Controllers\Api\Product\V1\Fetch;

use App\Actions\CustomerActions;
use App\Actions\StoreActions;
use App\Actions\ProductActions;
use App\Http\Controllers\Controller;
use App\Exceptions\NotFoundException;

class VendorDashboardProductsController extends Controller
{
    public function __construct(
        private ProductActions $productActions,
        private StoreActions $storeActions,
        private CustomerActions $customerActions,
    ) {
    }

    public function handle()
    {       
        $id = auth()->id();

        $customer = $this->customerActions->getCustomerByID($id);

        $store = $this->storeActions->getStoreById($id, ['account_details']);

        $reviews = [];

        $store_id = $store->id;

        $relationships = [
            'product_images', 'product_likes',
        ];

        $products = $this->productActions->getAllProductRecordsByStore($store_id, $relationships);

        if (is_null($products)) {
            throw new NotFoundException('Store has no products available yet');
        }

        $data = ['store' => $store, 'product' => $products, 'reviews' => $reviews, 'customer' => $customer];

        return successResponse('Store Products Fetched Successfully', 200, [
            'data' => $data,
        ]);
    }
}
