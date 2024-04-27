<?php

namespace App\Http\Controllers\Api\Cart\V1\Checkout;

use App\Actions\CartActions;
use App\Actions\OrderActions;
use App\Http\Controllers\Controller;


class CartCheckoutController extends Controller 
{
    public function __construct(
        private OrderActions $orderActions,
        private CartActions $cartActions
    )
    {}

    // public function handle()
    // {
    //     $userId = auth()->id();
    //     $email = auth()->user()->email_address;

    //     $relationships = [
    //         'product'
    //     ];

    //     $cartRecords = $this->cartActions->getCartItemsRecord($userId, $relationships);

    //     foreach($cartRecords as $cartItem)
    //     {   
    //         $order = 
    //     }
    //     // if(is_null($cartRecords)){
    //     //     throw new NotFoundException('No Product yet on cart kindly add one now', 200);
    //     // }

    //     // return successResponse('Cart Products fetched successfully', 200, $cartRecords);
    // }
    // }
    
}