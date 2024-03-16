<?php

namespace App\Http\Requests\Api\Vendor\V1\Onboarding;

use App\Http\Requests\Api\Base\BaseFormRequest;

class CreateVendorRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'between:3,200'],
            'last_name' => ['required', 'string', 'between:3,200'],
            'phone_number' => ['required', 'string', 'digits:11', 'unique:vendors,phone_number'],
            'nin_number' => ['required', 'string', 'digits:11', 'unique:vendors,nin_number'],
            'email_address' => ['required', 'string', 'email', 'between:3,200', 'unique:vendors,email_address'],
            'address' => ['required', 'string', 'between:3,200'],
            'password' => ['required', 'string', 'between:8,20'],
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'First name is required',
            'first_name.string' => 'First name must be string',
            'first_name.between' => 'First name must be between 3 to 200 characters',
            'last_name.required' => 'Last name is required',
            'last_name.string' => 'Last name must be string',
            'last_name.between' => 'Last name must be between 3 to 200 characters',
            'phone_number.required' => 'Phone number is required',
            'phone_number.string' => 'Phone number must be string',
            'phone_number.digits' => 'Phone number must be 11 digits',
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
            'nin_number.required' => 'NIN number is required',
            'nin_number.exists' => 'NIN already exists on our database',
            'nin_number.digits' => 'NIN number must be 11 digits',
            'nin_number.string' => 'NIN number must be string',
            'address.required' => 'Address must be fill',
            'address.string' => 'Address must be string',
            'address.between' => 'Address must be between 10 to 15 characters',
        ];
    }
}
