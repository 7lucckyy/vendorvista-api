<?php

namespace App\Http\Controllers\Api\Product\V1\Create;

use cloudinary;
use App\Actions\StoreActions;
use App\Actions\ProductActions;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Product\V1\Create\StoreProductRequest;

class CreateNewProductController extends Controller 
{
    public function __construct(
        private ProductActions $productActions,
        private StoreActions $storeActions
    )
    {

    }

    public function handle(StoreProductRequest $request)
    {
        $vendorId = auth()->id();   
        
        $validatedRequest = $request->validated();

        $relationships = [
            'vendor'
        ];

        $vendor = $this->storeActions->getStoreById(
            id : $vendorId,
            relationships: $relationships
            
        );

        $storeId = $vendor->id;


        $img_path = cloudinary()->upload($validatedRequest['image']->getRealPath())->getSecurePath();

        DB::transaction(function () use ($validatedRequest, $storeId, $img_path) {
            $product = $this->productActions->createProductRecord([
                'product_payload' => [
                    'name' => $validatedRequest['name'],
                    'description' => $validatedRequest['description'],
                    'price' => $validatedRequest['price'],
                    'quantity' => $validatedRequest['quantity'],
                    'store_id' => $storeId,
                ]
            ]);

            $product_img = $this->productActions->createProductImageRecord([
                'product_img_payload' => [
                    'product_id' => $product->id,
                    'img_path' => $img_path,
                ]
            ]); 
        });
        return successResponse(
            'Product record was created successfully',
            201,

        );
         
    }
}