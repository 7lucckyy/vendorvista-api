<?php 

namespace App\Actions;

use App\Models\Product;
use App\Models\ProductLike;

class ProductLikeActions 
{
    public function __construct(
        private ProductLike $productLike,
        private Product $product
    ){

    }

    public function createLikedProductRecord($likedProductRecordOptions)
    {
        $data = $likedProductRecordOptions['liked_product_payload'];

        return $this->productLike->create($data);

    }

    public function incrementProductLikeRecord($incrementProductLikeRecordOptions){
        $entity_id = $incrementProductLikeRecordOptions['id'];

        return $this->product->where(['id' => $entity_id])->increment('total_likes', 1);
    }

}