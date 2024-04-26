<?php

namespace App\Http\Requests\Api\Customer\V1\Onboarding;

use App\Http\Requests\Api\Base\BaseFormRequest;

class CreateNewUserRequest extends BaseFormRequest
{
    public function rules(): array
    {
        $rules = [
            'user_type' => ['required', 'string', 'in:customer,vendor'], // Adjust 'customer' and 'vendor' according to your user types
            'full_name' => [],
            'phone_number' => [],
            'email_address' => [],
            'password' => [],
            'address' => [],
            'nin_number' => [],
            'store_name' => [],
        ];

        $userType = $this->user_type; // Access the user_type directly from the request
        // Add fields based on user type
        if ($userType === 'vendor') {
            $rules['full_name'] = ['nullable', 'string', 'between:3,200']; // make full_name nullable for vendor
            $rules['phone_number'] = ['nullable', 'string', 'digits:11']; // make phone_number nullable for vendor
            $rules['address'] = ['nullable', 'string', 'between:8,30']; 
            $rules['store_name'] = ['required', 'string', 'between:3,20', 'unique:stores,store_name'];
        } elseif ($userType === 'customer') {
            $rules['full_name'] = ['required', 'string', 'between:3,200'];
            $rules['phone_number'] = ['required', 'string', 'digits:11', 'unique:customers,phone_number'];
            $rules['email_address'] = ['required', 'string', 'email', 'between:3,200', 'unique:customers,email_address'];
            $rules['password'] = ['required', 'string', 'between:8,20'];
            $rules['address'] = ['required', 'string', 'between:8,30'];
            $rules['nin_number'] = ['nullable', 'string', 'max:255']; // NIN number nullable for customers
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'full_name.required' => 'Full name is required',
            'full_name.string' => 'Full name must be string',
            'full_name.between' => 'Full name must be between 3 to 200 characters',
            'phone_number.required' => 'Phone number is required',
            'phone_number.string' => 'Phone number must be string',
            'phone_number.between' => 'Phone number must be 11 digits',
            'phone_number.unique' => 'Phone number has already been taken',
            'email_address.required' => 'Email address is required',
            'email_address.string' => 'Email address must be a string',
            'email_address.exists' => 'Email address has already been taken',
            'email_address.email' => 'Email address must be a valid email address',
            'email_address.between' => 'Email address must be between 3 to 200 characters',
            'password.required' => 'Password is required',
            'password.string' => 'Password must be a string',
            'password.confirmed' => 'Password must match Password Confirmation',
            'password.between' => 'Password must be between 8 to 20 characters',
            'address.between' => 'Address must be between 8 to 20 characters',
            'nin_number.required' => 'NIN number is required for vendors',
            'nin_number.string' => 'NIN number must be a string',
            'nin_number.max' => 'NIN number must not exceed 255 characters',
            'user_type.required' => 'User type must be provided',
        ];
    }
}
