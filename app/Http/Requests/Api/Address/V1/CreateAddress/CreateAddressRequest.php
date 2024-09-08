<?php

namespace App\Http\Requests\Api\Address\V1\CreateAddress;
use App\Http\Requests\Api\Base\BaseFormRequest;

class CreateAddressRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'latitude' => ['required'],
            'longitude' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'latitude.required' => 'Latitude is required kindly provide',
            
            'longitude.required' => 'Longitude is required kindly provide',
            
        ];
    }

}