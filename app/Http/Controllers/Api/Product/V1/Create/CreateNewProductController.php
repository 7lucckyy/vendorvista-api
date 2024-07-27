<?php

namespace App\Http\Controllers\Api\Product\V1\Create;

use App\Exceptions\NotFoundException;

use App\Actions\StoreActions;
use App\Actions\ProductActions;
use App\Actions\ProductVariantActions;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Product\V1\Create\StoreProductRequest;


class CreateNewProductController extends Controller 
{
    public function __construct(
        private ProductActions $productActions,
        private StoreActions $storeActions,
        private ProductVariantActions $productVariantActions,
    )
    {

    }

    public function handle(StoreProductRequest $request)
    {
        $vendorId = auth()->id(); 
         
        $validatedRequest = $request->validated();    
        
        $relationships = ['customer'];
        $vendor = $this->storeActions->getStoreById(
            id : $vendorId,
            relationships: $relationships        
        );

        if(is_null($vendor)){
            throw new NotFoundException('Vendor does not have store kindly create one ', 404);
        }
        
        $storeId = $vendor->id;

        DB::transaction(function () use ($validatedRequest, $storeId) {
           
            $product  = $this->productActions->createProductRecord([
                'product_payload' => [
                    'name' => $validatedRequest['name'],
                    'description' => $validatedRequest['description'],
                    'price' => $validatedRequest['price'],
                    'quantity' => $validatedRequest['quantity'],
                    'store_id' => $storeId,
                ]
            ]);

            foreach($validatedRequest['product_variants'] as $product_variant)
            {
               $this->productVariantActions->createProductVariantRecord([
                'create_payload' => [
                    'product_id' => $product->id,
                    'name' => $product_variant['name'],
                    'value' => $product_variant['value'],
                    'price' => $product_variant['price']
                ]
            
                ]);

            }
            
            // Create product image records
            foreach ($validatedRequest['images'] as $image) {
                $product->product_images()->create(['img_path' => $image]);

            }
            
        });

        
        return successResponse('Product record was created successfully', 201);
    }
}
