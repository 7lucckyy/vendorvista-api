<?php

namespace App\Http\Controllers\Api\Product\V1\Create;

use Log;

use App\Actions\StoreActions;
use App\Actions\ProductActions;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Exceptions\NotFoundException;
use App\Actions\ProductVariantActions;
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
            $productVariants = collect($validatedRequest['product_variants'] ?? []);

            if ($productVariants->isNotEmpty()) {
                $productVariants->each(function ($variant) use ($product) {
                    try {
                        $this->productVariantActions->createProductVariantRecord([
                            'create_payload' => [
                                'product_id' => $product->id,
                                'name' => $variant['name'] ?? '',
                                'value' => $variant['value'] ?? '',
                                'price' => $variant['price'] ?? 0,
                            ]
                        ]);
                    } catch (\Exception $e) {
                        return errorResponse('failed to create variants');                        // Optionally, you might want to continue with the next variant or throw an exception
                    }
                });
            }
            // Create product image records
            foreach ($validatedRequest['images'] as $image) {
                $product->product_images()->create(['img_path' => $image]);
            }     
        });

        
        return successResponse('Product record was created successfully', 201);
    }
}
