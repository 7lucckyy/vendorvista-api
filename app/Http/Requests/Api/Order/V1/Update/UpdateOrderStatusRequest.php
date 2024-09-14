<?php

namespace App\Http\Requests\Api\Order\V1\Update;
use App\Http\Requests\Api\Base\BaseFormRequest;

class UpdateOrderStatusRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'order_status' => ['required', 'string']
        ];
    }

    public function messages(): array
    {
        return [
            'order_status.required' => 'Order status is required',
            'order_status.string' => 'Order status must be string'
        ];
    }
}