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

    public function getAllProductRecordsByStore($store_id, $relationships)
    {
        return $this->product->with($relationships)->where([
            'store_id' => $store_id
        ])->get();
    }

    public function getAllProduct($relationships)
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

    public function getLatestProductRecord($getLatestProductRecordsOptions,$relationships)
    {
        $limit = $getLatestProductRecordsOptions['limit'];

        return $this->product->with($relationships)
        ->where('quantity', '>=', 1)
        ->orderBy('created_at', 'DESC')
        ->paginate($limit);    
    }
}