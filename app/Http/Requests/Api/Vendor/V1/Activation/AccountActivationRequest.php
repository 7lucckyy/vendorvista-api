<?php

namespace App\Http\Requests\Api\Vendor\V1\Activation;
use App\Http\Requests\Api\Base\BaseFormRequest;



class AccountActivationRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return
        [
            'full_name' => ['required', 'string', 'between:3,200'],
            'account_name' => ['required', 'string', 'between:3,200'],
            'account_number' => ['required', 'string', 'digits:10'],
            'bank_name' => ['required', 'string', 'between:3,50'],
            'nin_number' => ['required', 'string', 'digits:11', 'unique:customers,nin_number'],
            'address' => ['required', 'string', 'between:8,30'],
            'is_registered' => ['required', 'boolean'],
            'cac_number' => ['nullable', 'string'],
            'phone_number' => ['required', 'string', 'digits:11'],
            'business_phone_number' => ['required', 'string', 'digits:11'],
            'description' => ['required', 'string'],
            'business_address' => ['required', 'string', 'between:8,30'],
            'business_category' => ['required', 'string'],
            'latitude' => ['required', 'string', 'between:4,30'],
            'longitude' => ['required', 'string', 'between:4,30'],
            'tiktok' => ['nullable', 'string'],
            'facebook' => ['nullable', 'string'],
            'instagram' => ['nullable', 'string'],
            'whatsapp' => ['nullable', 'string'],
            'cac_certificate' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:5120'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:5120'],
        ];
    }


    public function messages(): array
    {
        return [
            'full_name.required' => 'Full name is required',
            'full_name.string' => 'Full name must be string',
            'full_name.between' => 'Full name must be between 3 to 200 characters',
            'account_name.required' => 'Account name is required',
            'account_name.string' => 'Account name must be string',
            'account_name.between' => 'Account name must be between 3 to 200 characters',
            'bank_name.required' => 'Bank name is required',
            'bank_name.string' => 'Bank name must be string',
            'bank_name.between' => 'Bank name must be between 3 to 200 characters',
            'account_number.required' => 'Account number must be provided',
            'account_number.digits' => 'Account number must be 10 digits',
            'phone_number.required' => 'Phone number can not be blank',
            'phone_number.string' => 'Phone number must be string',
            'phone_number.digits' => 'Phone number must be 11 digits',
            'address.required' => 'Address is required',
            'address.between' => 'Address must be between 8 to 20 characters',
            'nin_number.required' => 'NIN number is required for vendors',
            'nin_number.string' => 'NIN number must be a string',
            'nin_number.max' => 'NIN number must not exceed 255 characters',
            'is_registered.required' => 'Registration status is required',
            'cac_certificate.mimes' => 'Kindly upload pictures as JPG, JPEG, PNG format',
            'cac_certificate.max' => 'Image size must be less than 1MB'
        ];
    }
}