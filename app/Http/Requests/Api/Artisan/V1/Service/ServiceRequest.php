<?php

namespace App\Http\Requests\Api\Artisan\V1\Service;

use App\Http\Requests\Api\Base\BaseFormRequest;

class ServiceRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'service_location' => ['required','string'],
            'artisan_id' => ['required','integer'],
            'service_type' => ['required','string'],
            'service_description' => ['required','string'],

        ];
    }

    public function messages()
    {
        return [
            'artisan_id.required' => 'Service ID is required',
            'artisan_id.integer' => 'Service ID must be an integer',
            'service_type.required' => 'Service Type is required',
            'service_type.string' => 'Service Type must be a string',
            'service_location.required' => 'Service Location is required',
            'service_location.string' => 'Service Location must be a string',
            'service_description.required' => 'Service Description is required',
            'service_description.string' => 'Service Description must be a string',

        ];
    }
}