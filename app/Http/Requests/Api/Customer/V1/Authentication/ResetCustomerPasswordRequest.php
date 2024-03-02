<?php


namespace App\Http\Requests\Api\Customer\V1\Authentication;
use App\Http\Requests\Api\Base\BaseFormRequest;


class ResetCustomerPasswordRequest extends BaseFormRequest
{

    public function rules()
    {
        return [
            'email_address' => ['required', 'string', 'email','between:3,200'],
        ];
    }

    public function messages(): array
    {
        return [
            'email_address.required' => 'Email address is required',
            'email_address.string' => 'Email address must be a string',
            'email_address.email' => 'Email address must be a valid email address',
            'email_address.between' => 'Email address must be between 3 to 200 characters'
        ];
    }

}