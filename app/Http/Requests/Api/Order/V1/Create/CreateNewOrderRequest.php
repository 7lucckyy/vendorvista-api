<?php

namespace App\Http\Requests\Api\Order\V1\Create;
use App\Http\Requests\Api\Base\BaseFormRequest;


class CreateNewOrderRequest extends BaseFormRequest
{
    public function rules(): array 
    {
        return [
            'id' => ['required', 'string'],
            'price' => ['required', 'string'],
            'quantity' => ['required', 'string'],
        ];
    }

    public function messages() : array
    {
        return [
            'product_id.required' => 'Product product_id must be provided',
            'product_id.string' => 'Product id must be a string',
            'price.required' => 'Product must have a price',
            'quantity.required' => 'Kindly define the product quantity in figures',
        ];
    }
}