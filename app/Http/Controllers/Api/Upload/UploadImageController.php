<?php

namespace App\Http\Controllers\Api\Upload;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Upload\UploadImageRequest;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\JsonResponse;
use Exception;

class UploadImageController extends Controller
{
    public function handle(UploadImageRequest $uploadImageRequest): JsonResponse
    {
        $image = $uploadImageRequest->file('image');

        if (!$image) {
            return errorResponse('No image provided', 400);
        }

        try {
            $uploadedImage = Cloudinary::upload($image->getRealPath())->getSecurePath();

            return successResponse('Image Uploaded Successfully', 200, ['image_url' => $uploadedImage]);
        } catch (Exception $e) {
            return errorResponse('Image upload failed: ' . $e->getMessage(), 500);
        }
    }
}