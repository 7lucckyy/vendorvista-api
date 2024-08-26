<?php

namespace App\Models;



class DeliveryAddress extends AbstractModel
{
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
