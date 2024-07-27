<?php


namespace App\Actions;


use App\Models\ProductVariant;

class ProductVariantActions 
{
   public function __construct(
    private ProductVariant $productAttribute,
   ){}

   public function createProductVariantRecord($createProductVariantRecordOptions)
   {
        $data = $createProductVariantRecordOptions['create_payload'];

        return $this->productAttribute->create($data);
   }

}