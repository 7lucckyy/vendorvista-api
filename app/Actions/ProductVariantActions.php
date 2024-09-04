<?php

namespace App\Actions;

use App\Models\ProductVariant;

class ProductVariantActions 
{
    public function __construct(private ProductVariant $productAttribute) {}

    public function createProductVariantRecord(array $createProductVariantRecordOptions): ProductVariant
    {
        $data = $createProductVariantRecordOptions['create_payload'];
        return $this->productAttribute->create($data);
    }

    public function updateProductVariantRecord(array $updateProductVariantRecordOptions): void
    {
        $entity_id = $updateProductVariantRecordOptions['product_id'];
        $data = $updateProductVariantRecordOptions['update_payload'];

        $this->productAttribute
        ->where('product_id', $entity_id)
        ->updateOrCreate(array_merge($data, ['product_id' => $entity_id]));
    }
}