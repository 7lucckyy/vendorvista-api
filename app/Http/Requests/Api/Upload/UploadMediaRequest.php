<?php

namespace App\Http\Requests\Api\Upload;

use App\Http\Requests\Api\Base\BaseFormRequest;

class UploadMediaRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'files.*' => ['required', 'file', 'mimes:jpeg,png,jpg,mp4,pdf', 'max:5120'], // 5MB
        ];
    }



    public function messages(): array
    {
        return [
            'files.*.mimes' => 'Only JPG, JPEG, PNG images, MP4 videos, and PDF files are allowed.',
            'files.*.required' => 'File upload is required.',
            'files.*.max' => 'File size must be less than 50MB.',
        ];
    }
}