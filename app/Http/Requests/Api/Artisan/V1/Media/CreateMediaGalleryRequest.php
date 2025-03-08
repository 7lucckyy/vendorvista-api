<?php

namespace App\Http\Requests\Api\Artisan\V1\Media;

use App\Http\Requests\Api\Base\BaseFormRequest;

class CreateMediaGalleryRequest extends BaseFormRequest
{
    public function rules(): array
    {
       return [
        'images' => ['required', 'array'],
       ];
    }

    public function messages(): array
    {
        return 
        [
           'images.required' => 'Product images are required'
        ];
    }
}