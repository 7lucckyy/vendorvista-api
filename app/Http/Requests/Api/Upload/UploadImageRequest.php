<?php

namespace App\Http\Requests\Api\Upload;

use App\Http\Requests\Api\Base\BaseFormRequest;

class UploadImageRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:15360'],
        ];
    }
    
    public function messages(): array
    {
        return [
            'image.required' => 'An image is required.',
            'image.image' => 'The uploaded file must be a valid image.',
            'image.mimes' => 'Kindly upload images in JPG, JPEG, or PNG format.',
            'image.max' => 'The image must be less than 15MB.',
        ];
    }
    
}
