<?php 

namespace App\Actions;

use App\Models\cart;

class CartActions 
{
    public function __construct(
        private cart $cart
        
        ){

        }

        public function createCartItemRecord($createCartItemRecordOptions)
        {

            $data = $createCartItemRecordOptions['create_cart_payload'];

            return $this->cart->create($data);

        }

        public function getCartItemsRecord($userId, $relationships = [])
        {
            

            return $this->cart->with($relationships)->where([
                'user_id' => $userId,
            ])->get();
        }

        public function deleteCartItemRecord($entity_id)
        {
            return $this->cart->where([
                'id' => $entity_id
            ])->delete();
        }

}