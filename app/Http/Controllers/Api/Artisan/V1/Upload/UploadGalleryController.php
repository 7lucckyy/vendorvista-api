<?php

namespace App\Http\Controllers\Api\Artisan\V1\Upload;

use App\Actions\ArtisanActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Artisan\V1\Media\CreateMediaGalleryRequest;
use Illuminate\Http\Request;

class UploadGalleryController extends Controller
{
    public function __construct(
        private ArtisanActions $artisanActions
    ) {}

    public function handle(Request $request)
    {
        $validatedRequest = $request->validate([
            'image' => ['required', 'string'],
        ]);
        $image = $validatedRequest['image'] ?? null;

        if (!$image) {
            return errorResponse('No image provided', 400);
        }

        $userId = auth()->id();

        $artisan = $this->artisanActions->getArtisanProfile($userId);

        $artisanId = $artisan->id;
        // Process the image
        $galleryImage = $this->artisanActions->createArtisanMediaGalleryRecordOptions([
            'entity_id' => $artisanId,
            'create_payload' => [
                'img_path' => $image,
            ],
        ]);

        return successResponse('Gallery Updated Successfully', 200, ['image' => $galleryImage]);
    }
}
