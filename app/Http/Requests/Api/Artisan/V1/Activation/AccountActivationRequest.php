<?php


namespace App\Http\Requests\Api\Artisan\V1\Activation;

use App\Http\Requests\Api\Base\BaseFormRequest;

class AccountActivationRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return  
        [
            'service' => ['required', 'string', 'between:5,200'],
            'about' => ['required', 'string', 'between:10,200'],
            'address' => ['required', 'string', 'between:10,100'],
            'profile_img' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return 
        [
            'service.required' => 'Kindly provide the service that you specialization',
            'service.string' => 'Service must be string',
            'service.between' => 'Service must be 5 characters above',
            'about.required' => 'About you is required field',
            'about.string' => 'About must be string',
            'about.between' => 'Service must be 18 characters above',
            'address.required' => 'address you is required field',
            'address.string' => 'address must be string',
            'address.between' => 'Service must be 18 characters above',
            'profile_img.max' => 'Image size must be less than 1MB'
        ];
    } 
}