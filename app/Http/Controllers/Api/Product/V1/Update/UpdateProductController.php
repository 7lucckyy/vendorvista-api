<?php

namespace App\Http\Controllers\Api\Product\V1\Update;

use Illuminate\Http\Request;
use App\Actions\ProductActions;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Actions\ProductVariantActions;
use App\Exceptions\UnAuthorizedException;

class UpdateProductController extends Controller
{
    public function __construct(
        private ProductActions $productActions,
        private ProductVariantActions $productVariantActions
    ){}

    public function handle(Request $request)
    {
        $userType = auth()->user()->user_type;

        if ($userType !== 'vendor') {
            throw new UnAuthorizedException('UnAuthorized Access', 401);
        }

        $product = $this->productActions->getProductById($request['product_id']);

        DB::transaction(function () use ($request, $product) {
        
            $this->productActions->updateProductRecord([
                'product_id' => $product->id,
                'update_payload' => [
                    'name' => $request['name'],
                    'description' => $request['description'],
                    'price' => $request['price'],
                    'quantity' => $request['quantity']
                ],
            ]);

            if (!empty($request['product_variants'])) 
            {
                foreach ($request['product_variants'] as $product_variant) 
                {
                    $this->productVariantActions->updateProductVariantRecord([
                        'product_id' => $product->id,
                        'update_payload' => [
                            'name' => $product_variant['name'],
                            'value' => $product_variant['value'],
                            'price' => $product_variant['price']
                        ]
                    ]);
                }
                
            }
    
            if (!empty($request['images'])) 
            {
                foreach ($request['images'] as $image) {
                    $this->productActions->updateProductImageRecord([
                        'product_id' => $product->id,
                        'update_payload' => [
                            'img_path' => $image
                        ]
                    ]);
                }
            }    
        });

        return successResponse('Product Updated Successfully', 200);
       
    } 
}