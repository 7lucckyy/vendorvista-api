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
            'store'
        ];
        
        $productDetails = $this->productActions->getProductById($productId, $relationships);

        $storeId = $productDetails->store->id;

        $storeProducts = $this->productActions->getAllProductRecordsByStore($storeId);

        $data = [
            'productDetails' => $productDetails,
            'storeProducts' => $storeProducts
        ];

        return successResponse('Product Details fetched successfully', 200, $data);

    }
}