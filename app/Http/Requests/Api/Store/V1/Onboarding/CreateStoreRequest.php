<?php

namespace App\Http\Requests\Api\Store\V1\Onboarding;

use App\Http\Requests\Api\Base\BaseFormRequest;



class CreateStoreRequest extends BaseFormRequest
{
    
    public function rules(): array
    {
        return [
            'store_name' => ['required', 'string', 'between:3,200', 'unique:stores,store_name'],
            'business_type' => ['required', 'digits:1'],
            'business_address' => ['required', 'string','between:3,200'],
            'is_registered' => ['required', 'boolean'],
            'cac_number' => ['string', 'digits:6']
        ];
    }

    public function messages(): array
    {
        return [
            'store_name.required' => 'Store name is required',
            'store_name.string' => 'Store name must be string',
            'store_name.between' => 'Store name must be between 3 to 200 characters',
            'type.required' => 'store type is required',
        ];
    }
}
