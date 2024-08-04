<?php

namespace App\Http\Requests\Api\Product\V1\Fetch;
use App\Http\Requests\Api\Base\BaseFormRequest;

class SearchProductRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'search' => ['required']

        ];
    }

    public function messages(): array
    {
        return [
            
            'search.required' => 'Search parameter is required',
        ];
    }
}