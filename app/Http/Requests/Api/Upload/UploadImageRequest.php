<?php

namespace App\Http\Requests\Api\Upload;

use App\Http\Requests\Api\Base\BaseFormRequest;

class UploadImageRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return
        [
            'images.*' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:15360'],
        ];
    }


    public function messages(): array
    {
        return [
            'images.*.mimes' => 'Kindly upload pictures as JPG, JPEG, PNG format',
            'images.*.required' => 'Product images are required',
            'images.*.max' => 'Image size must be less than 15MB'
        ];
    }
}