<?php

namespace App\Actions;

use App\Models\AccountDetails;

class BankDetailsActions 
{
    public function __construct(
        private AccountDetails $account
    ){}

    public function createAccountDetailsRecord($createAccountDetailsRecordOptions)
    {
        $data = $createAccountDetailsRecordOptions['create_payload'];

        return $this->account->create($data);

    }

    public function updateAccountDetailsRecord($updateAccountRecordOptions){
        $entity_id = $updateAccountRecordOptions['entity_id'];
        $data =  $updateAccountRecordOptions['update_payload'];

        return $this->account->update($data);
    }
}