<?php

namespace App\Http\Controllers\Api\Order\V1\Create;

use App\Actions\OrderActions;
use App\Http\Controllers\Controller;


class CreateNewOrderController extends Controller
{
    public function __construct(
        OrderActions $orderActions
    )
    {

    }

    public function handle()
    {
        
    }
}