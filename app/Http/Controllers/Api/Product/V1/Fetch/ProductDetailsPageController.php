<?php


namespace App\Http\Controllers\Api\Product\V1\Fetch;

use App\Actions\ProductActions;
use Illuminate\Http\Request;

class ProductDetailsPageController 
{
    public function __construct(
        private ProductActions $productActions,
    ){}

    public function handle(Request $request){

        $productId = $request['id'];

        $relationships = [
            'store',
            'product_images'
        ];
        
        $productDetails = $this->productActions->getProductById($productId, $relationships);

        $storeId = $productDetails->store->id;

        $storeProducts = $this->productActions->getAllProductRecordsByStore($storeId, ['product_images']);

        $data = [
            'productDetails' => $productDetails,
            'storeProducts' => $storeProducts
        ];

        return successResponse('Product Details fetched successfully', 200, $data);

    }
}