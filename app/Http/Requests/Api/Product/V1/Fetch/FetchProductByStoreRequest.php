<?php

namespace App\Http\Requests\Api\Product\V1\Fetch;

use App\Http\Requests\Api\Base\BaseFormRequest;

class FetchProductByStoreRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['required', 'string'],
            'quantity' => ['required']

        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Product ID is required',
            'id.string' => 'Product ID must be string',
            'quantity.required' => 'Product Quantity is required',
        ];
    }
}
