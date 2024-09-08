<?php


namespace App\Http\Requests\Api\Customer\V1\Update;
use App\Http\Requests\Api\Base\BaseFormRequest;

class UpdateProfileRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'full_name' => ['sometimes', 'string', 'max:55'],
            'email_address' => ['sometimes', 'email', 'max:55'],
            'phone_number' => ['sometimes', 'string', 'max:20'],
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.string' => 'The full name must be a valid string.',
            'full_name.max' => 'The full name must not exceed 55 characters.',
            'email_address.email' => 'The email address must be a valid email format.',
            'email_address.max' => 'The email address must not exceed 55 characters.',
            'phone_number.string' => 'The phone number must be a valid string.',
            'phone_number.max' => 'The phone number must not exceed 20 characters.',
        ];
    }
}