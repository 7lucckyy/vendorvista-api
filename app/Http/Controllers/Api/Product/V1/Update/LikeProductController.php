<?php

namespace App\Http\Controllers\Api\Product\V1\Update;

use App\Actions\ProductActions;
use App\Actions\ProductLikeActions;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Api\Product\V1\Update\LikeProductRequest;

class LikeProductController 
{
    public function __construct(
        private ProductLikeActions $productLikeActions

    )
    {
        
    }

    public function handle(LikeProductRequest $request)
    {
        $userId = auth()->id(); 

        $validatedRequest = $request->validated();

        $productId = $validatedRequest['id'];

        DB::transaction(function () use ($validatedRequest, $userId, $productId) {           
            // Create product record
            $likeProduct = $this->productLikeActions->createLikedProductRecord([
                'like_product_payload' => [
                    'product_id' => $validatedRequest['id'],
                    'user_id' => $userId,
                ]
            ]);
            
            $this->productLikeActions->incrementProductLikeRecord($productId);
            
        });

        return successResponse('Product Liked Successfully', 200);

    }
}