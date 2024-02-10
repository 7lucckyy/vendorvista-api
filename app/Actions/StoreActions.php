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
            'id' => $id
        ])->first();
    }



    
}