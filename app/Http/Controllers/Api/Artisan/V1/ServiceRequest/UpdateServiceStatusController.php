<?php

namespace App\Http\Controllers\Api\Artisan\V1\ServiceRequest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\ServiceRequestActions;

class UpdateServiceStatusController extends Controller
{
    public function __construct(
        private ServiceRequestActions $serviceRequestActions,
    ){}

    public function handle(Request $request)
    {
        $serviceRequest = $this->serviceRequestActions->updateServiceRequestRecord([
            'entity_id' => $request['service_request_id'],
            'update_payload' => [
                'service_status' => $request['service_status'],
            ]
        ]);

        return successResponse('Service status updated successfully', 200, $serviceRequest);
    }
}