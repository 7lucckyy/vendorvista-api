<?php

namespace App\Http\Requests\Api\Product\V1\Fetch;

use App\Http\Requests\Api\Base\BaseFormRequest;

class FetchProductByStoreRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['required', 'string'],

        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Store ID is required',
            'id.string' => 'Store ID must be string',

        ];
    }
}
