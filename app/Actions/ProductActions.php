<?php

namespace App\Actions;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductLike;

class ProductActions
{
    public function __construct(
        private Product $product,
        private ProductImage $productImage,
        private ProductLike $productLike
    ) {
    }

    public function createProductRecord($createProductRecordOptions)
    {
        $data = $createProductRecordOptions['product_payload'];

        return $this->product->create($data);
    }

    public function getProductById($id, $relationships = [])
    {
        return $this->product->with($relationships)->where([
            'id' => $id,
        ])->first();
    }

    public function createProductImageRecord($createProductImageRecordOptions)
    {
        $data = $createProductImageRecordOptions['product_img_payload'];

        return $this->productImage->create($data);
    }

    public function getAllProductRecordsByStore($store_id, $relationships = [])
    {
        return $this->product->with($relationships)->where([
            'store_id' => $store_id,
        ])->get();
    }

    public function getAllProduct($relationships = [])
    {
        return $this->product->with($relationships)->get();
    }

    public function getHotSalesRecord($getHotSalesRecordOptions, $relationships = [])
    {
        $limit = $getHotSalesRecordOptions['limit'];

        return $this->product->with($relationships)->where('quantity', '>=', 1)
            ->orderBy('total_orders', 'DESC')
            ->paginate($limit);
    }

    public function getLatestProductRecord($getLatestProductRecordsOptions, $relationships = [])
    {
        $limit = $getLatestProductRecordsOptions['limit'];

        return $this->product->with($relationships)
            ->where('quantity', '>=', 1)
            ->orderBy('created_at', 'DESC')
            ->paginate($limit);
    }

    public function getMostLikedProductRecord($getMostLikedProductRecordOptions, $relationships = [])
    {
        $limit = $getMostLikedProductRecordOptions['limit'];

        return $this->product->with($relationships)
            ->where('quantity', '>=', 1)
            ->orderBy('total_likes', 'DESC')
            ->paginate($limit);
    }

    public function updateProductRecord($updateProductRecordOptions, $relationships = [])
    {
        $entity_id = $updateProductRecordOptions['product_id'];
        $data = $updateProductRecordOptions['update_product_payload'];

        $this->product->with($relationships)->where([
            'id' => $entity_id,
        ])->update($data);
    }

    public function checkProductAvailabilityRecord($checkProductAvailabilityRecordOptions, $relationships){
        $entity_id = $checkProductAvailabilityRecordOptions['id'];
        $product_quantity = $checkProductAvailabilityRecordOptions['quantity'];
        return $this->product->with($relationships)
            ->where('id', $entity_id)
            ->where('quantity', '>=', $product_quantity)
            ->first();
    }

    public function decrementQuantity($entity_id)
    {
        $this->product->where('id', $entity_id)->decrement('quantity', 1);
                           
    }

    public function incrementTotalOrder($entity_id)
    {
        $this->product->where('id', $entity_id)->increment('total_orders', 1);
    }

}
