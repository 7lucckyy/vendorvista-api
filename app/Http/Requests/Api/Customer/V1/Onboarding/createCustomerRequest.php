<?php

namespace App\Http\Requests\Api\Customer\V1\Onboarding;

use App\Http\Requests\BaseFormRequest;


class CreateCustomerRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'between:3,200'],
            'last_name' => ['required', 'string', 'between:3,200'],
            'phone_number' => ['required', 'string', 'digits:11', 'unique:customers,phone_number'],
            'email_address' => ['required', 'string', 'email','between:3,200', 'unique:drivers,email_address'],
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
        ];
    }
}
