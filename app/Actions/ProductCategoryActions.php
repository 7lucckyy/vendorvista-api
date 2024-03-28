<?php 

namespace App\Actions;

use App\Models\ProductCategory;

class ProductCategoryActions 
{
    public function __construct(
        private ProductCategory $productCategory
    ){

    }

    public function createProductCategoryRecord($createProductCategoryRecordOptions)
    {
        $data = $createProductCategoryRecordOptions('create_payload');
        return $this->productCategory->create($data);

    }

    public function getAllProductCategoryRecord($relationships = [])
    {
        return $this->productCategory->with($relationships)->get();

    }

    
    
   
}