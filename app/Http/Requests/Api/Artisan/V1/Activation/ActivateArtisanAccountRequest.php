<?php

namespace App\Http\Requests\Api\Artisan\V1\Activation;

use App\Http\Requests\Api\Base\BaseFormRequest;

class ActivateArtisanAccountRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'service' => ['required', 'string' ,'max:100'],
            'about' => ['required', 'string', 'max:1000'],
            'whatsapp_number' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'between:10,100'],
            'nin_number' => ['required', 'string', 'max:255'],
            'img_path' => ['required', 'string', 'url'],
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
            'skills' => ['array'],
            'skills.*' => ['required'],
            'proficiency' => ['array'],
            'proficiency.*' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            // Service messages
            'service.required' => 'Service is required',
            'service.string' => 'Service must be text',
            'service.max' => 'Service must be less than 100 characters',

           // Address messages
            'address.required' => 'Address is required',
            'address.string' => 'Address must be text',
            'address.between' => 'Address must be between 10-100 characters',

            'skills.array' => 'Skill must be an array',
            'skills.*.required' => 'Skill is required',
            'proficiency.array' => 'Proficiency must be an array',
            'proficiency.*.required' => 'Proficiency is required',

            //Image path messages
            'img_path.required' => 'Image reference is required',
            'img_path.string' => 'Image path must be a valid string',
            'img_path.url' => 'Image path must be a valid URL',

            'latitude.required' => 'Latitude is required',
            'latitude.numeric' => 'Latitude must be a number',
            'longitude.required' => 'Longitude is required',
            'longitude.numeric' => 'Longitude must be a number',
        ];
    }
}