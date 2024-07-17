<?php


namespace App\Actions;

use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;

class ProductVariantActions 
{
   public function __construct(
    private ProductAttribute $productAttribute,
    private ProductAttributeValue $productAttributeValue,
   ){}


   public function createProductAttributeRecord($createProductAttributesRecordOptions)
   {
        $data = $createProductAttributesRecordOptions['create_payload'];

        return $this->productAttribute->create($data);
   }

   
   public function createProductAttributeValueRecord($createProductAttributeValueRecordOption)
   {
        $data = $createProductAttributeValueRecordOption['create_payload'];
   }
}