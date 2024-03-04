<?php

namespace App\Http\Controllers\Api\Product\V1\Create;

use Cloudinary;
use App\Actions\StoreActions;
use App\Actions\ProductActions;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Exceptions\UnAuthorizedException;
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
        
        if (auth()->user()->user_type !== 'vendor') 
        {
            throw new UnAuthorizedException('Access Denied', 403);
        }
        
        $validatedRequest = $request->validated();

        $relationships = ['customer'];
        $vendor = $this->storeActions->getStoreById(
            id : $vendorId,
            relationships: $relationships        
        );

        $storeId = $vendor->id;

        // Array to hold all uploaded image paths
        $imgPaths = [];

        DB::transaction(function () use ($validatedRequest, $storeId, &$imgPaths) {
            // Upload each image to Cloudinary and store the URL path
            foreach ($validatedRequest['images'] as $image) {
                $img_path = Cloudinary::upload($image->getRealPath())->getSecurePath();
                $imgPaths[] = $img_path;
            }

            // Create product record
            $product = $this->productActions->createProductRecord([
                'product_payload' => [
                    'name' => $validatedRequest['name'],
                    'description' => $validatedRequest['description'],
                    'price' => $validatedRequest['price'],
                    'quantity' => $validatedRequest['quantity'],
                    'store_id' => $storeId,
                ]
            ]);

            // Create product image records
            foreach ($imgPaths as $img_path) {
                $this->productActions->createProductImageRecord([
                    'product_img_payload' => [
                        'product_id' => $product->id,
                        'img_path' => $img_path,
                    ]
                ]); 
            }
        });

        return successResponse('Product record was created successfully', 201);
    }
}
