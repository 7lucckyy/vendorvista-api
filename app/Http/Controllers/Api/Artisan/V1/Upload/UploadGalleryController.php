<?php

namespace App\Http\Controllers\Api\Artisan\V1\Upload;

use App\Actions\ArtisanActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Artisan\V1\Media\CreateMediaGalleryRequest;

class UploadGalleryController extends Controller
{
    public function __construct(
        private ArtisanActions $artisanActions
    ) {}

    public function handle(CreateMediaGalleryRequest $request)
    {
        $validatedRequest = $request->validated();
        $images = $validatedRequest['images'] ?? [];

        if (empty($images)) {
            return errorResponse('No images provided', 400);
        }

        $galleryImages = [];

        foreach ($images as $image) {
            $galleryImages[] = $this->artisanActions->createArtisanMediaGalleryRecordOptions($image);
        }

        return successResponse('Gallery Updated Successfully', 200, $galleryImages);
    }
}
