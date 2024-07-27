<?php

namespace App\Http\Controllers\Api\Upload;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Upload\UploadImageRequest;
use Cloudinary;

class UploadImageController extends Controller
{
    public function handle(UploadImageRequest $uploadImageRequest)
    {
        $validatedRequest = $uploadImageRequest->validated();

        $imgPaths = [];
        foreach ($validatedRequest['images'] as $image) {
            $img_path = Cloudinary::upload($image->getRealPath())->getSecurePath();
            $imgPaths[] = $img_path;
        }
        




        return successResponse('Image Uploaded Successfully', 200, $imgPaths);

    }
}