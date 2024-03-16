<?php

namespace App\Jobs;

use Exception;
use Cloudinary;
use App\Jobs\Base\BaseJob;
use App\Actions\ProductActions;
use Illuminate\Support\Facades\Log;

class UploadImageToCloudinary extends BaseJob
{
    private $productId;
    private $imagePath;

    /**
     * Create a new job instance.
     *
     * @param string $productId
     * @param string $imagePath
     * @return void
     */
    public function __construct(string $productId, string $imagePath)
    {
        $this->productId = $productId;
        $this->imagePath = $imagePath;
    }

    /**
     * Execute the job.
     *
     * @param ProductActions $productActions
     * @return void
     */
    public function handle(ProductActions $productActions)
    {
        try {
            $uploadedImagePath = Cloudinary::upload($this->imagePath)->getSecurePath();

            $this->createProductImageRecord($productActions, $uploadedImagePath);

            Log::info('Image uploaded and product image record created successfully.', [
                'product_id' => $this->productId,
                'uploaded_image_path' => $uploadedImagePath
            ]);
        } catch (Exception $e) {
            Log::error('Failed to upload image to Cloudinary or create product image record.', [
                'product_id' => $this->productId,
                'error_message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString()
            ]);
        }
    }

    /**
     * Create a product image record.
     *
     * @param ProductActions $productActions
     * @param string $uploadedImagePath
     * @return void
     */
    private function createProductImageRecord(ProductActions $productActions, string $uploadedImagePath)
    {
        $productActions->createProductImageRecord([
            'product_img_payload' => [
                'product_id' => $this->productId,
                'img_path' => $uploadedImagePath,
            ],
        ]);
    }
}
