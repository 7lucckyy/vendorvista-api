<?php

namespace App\Http\Requests\Api\Order\V1\Create;
use App\Http\Requests\Api\Base\BaseFormRequest;


class CreateNewOrderRequest extends BaseFormRequest
{
    public function rules(): array {
        return [
            'name' => ['required', 'string'],
            'description' => ['required', 'string', 'between:7,100'],
            'price' => ['required', 'string'],
            'quantity' => ['required', 'string'],
        ];
    }
}