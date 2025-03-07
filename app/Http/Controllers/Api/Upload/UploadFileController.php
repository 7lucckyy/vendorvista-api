<?php

namespace App\Http\Controllers\Api\Upload;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Upload\UploadMediaRequest;
use Cloudinary;

class UploadFileController extends Controller
{
    public function handle(UploadMediaRequest $request)
{
    if (!$request->hasFile('files')) {
        return errorResponse('No files uploaded', 400);
    }

    $validated = $request->validated();
    $uploadedFiles = [];

    foreach ($request->file('files') as $file) {
        $mimeType = $file->getMimeType();
        $resourceType = $this->getResourceType($mimeType);

        $uploadResult = Cloudinary::upload(
            $file->getRealPath(),
            [
                'resource_type' => $resourceType,
                'folder' => 'uploads/' . $resourceType
            ]
        );

        $uploadedFiles[] = [
            'url' => $uploadResult->getSecurePath(),
            'type' => $this->getFileTypeCategory($mimeType),
            'resource_type' => $resourceType,
            'original_name' => $file->getClientOriginalName(),
            'size' => $file->getSize(),
        ];
    }

    return successResponse(
        'Files uploaded successfully',
        200,
        $uploadedFiles
    );
}

}