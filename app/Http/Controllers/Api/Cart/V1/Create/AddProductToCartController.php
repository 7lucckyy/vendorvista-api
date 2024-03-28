<?php

namespace App\Http\Controllers\Api\Order\V1\Create;

use App\Actions\ProductActions;

class AddProductToCartController 
{
    public function __construct(
        private ProductActions $productActions,
    ){}

    public function handle()
    {
        
    }
}