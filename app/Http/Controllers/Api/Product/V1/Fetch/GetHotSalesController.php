<?php

namespace App\Http\Controllers\Api\Product\V1\Fetch;
use App\Actions\ProductActions;
use App\Http\Controllers\Controller;
use App\Exceptions\NotFoundException;


class GetHotSalesController extends Controller
{
    public function __construct(
        private ProductActions $productActions
    )
    {

    }

    public function handle()
    {
        $relationships = 
        [
            'product_images'
        ];

        $getHotSalesRecordOptions = 
        [
            'limit' => 10
        ];

        $products = $this->productActions->getHotSalesRecord($getHotSalesRecordOptions,$relationships);

        if(is_null($products)){
            throw new NotFoundException('No product records found');
        }

        return successResponse(
            'Products Fetched Successfully',
            200,
            [        
                    'products' => $products   
            ]
        );

    }
}