<?php

namespace App\Actions;
use App\Models\Product;
use App\Models\ProductImage;

class ProductActions 
{
    public function __construct(
        private Product $product,
        private ProductImage $productImage
    )
    {

    }


    public function createProductRecord($createProductRecordOptions)
    {
        $data = $createProductRecordOptions['product_payload'];

        return $this->product->create($data);
    }

    public function getProductById($id, $relationships = [])
    {
        return $this->product->with($relationships)->where([
            'id' => $id
        ])->first();
    }

    public function createProductImageRecord($createProductImageRecordOptions)
    {
        $data = $createProductImageRecordOptions['product_img_payload'];

        return $this->productImage->create($data);
        
    }
}