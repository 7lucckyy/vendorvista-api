<?php

namespace App\Http\Controllers\Api\Artisan\V1\ServiceRequest;

use App\Actions\ServiceRequestActions;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceRequestController extends Controller
{
    public function __construct(
        private ServiceRequestActions $serviceRequestActions,

    ){}

    public function handle(Request $request)
    {

        $customerId = auth()->id();

        $serviceRequest = $this->serviceRequestActions->createServiceRequestRecord([
            'create_payload' => [
                'customer_id' => $customerId,
                'service_location' => $request['service_location'],
                'artisan_id' => $request['artisan_id'],
                'service_type' => $request['service_type'],
                'service_description' => $request['service_description'],
                'service_status' => 'pending',
            ]
        ]);

        return successResponse('Service requested successfully', 201, $serviceRequest);

    }
}