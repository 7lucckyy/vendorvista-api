<?php

namespace App\Http\Requests\Api\Artisan\V1\Media;

use App\Http\Requests\Api\Base\BaseFormRequest;

class CreateMediaGalleryRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'image' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'image.required' => 'Product images are required',
            'image.*.required' => 'Each image URL is required',
            'image.*.url' => 'Each image must be a valid URL',
        ];
    }
}