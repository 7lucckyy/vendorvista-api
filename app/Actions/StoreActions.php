<?php

namespace App\Actions;

use App\Models\Store;

class StoreActions 
{
    public function __construct(
        private Store $store
    )
    {

    }
    public function createStoreRecord($createStoreRecordOptions)
    {
        $data = $createStoreRecordOptions['store_payload'];

        return $this->store->create($data);
    }

    public function getStoreById($id, $relationships = [])
    {
        return $this->store->with($relationships)->where([
            'vendor_id' => $id
        ])->first();
    }

    public function deleteStoreRecord($entity_id){
        
        return $this->store->where([
            'id' => $entity_id
        ])->delete();
    }

    public function updateStoreRecord($updateStoreRecordOptions)
    {
        $entity_id = $updateStoreRecordOptions['store_id'];
        $data = $updateStoreRecordOptions['update_payload'];
        return $this->store->where([
            'id' => $entity_id
        ])->update($data);
    }

    



    
}