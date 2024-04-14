<?php

namespace App\Http\Controllers\Api\Vendor\V1\Authentication;

use App\Actions\VendorActions;
use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Vendor\V1\Authentication\AuthenticateVendorRequest;
use Illuminate\Support\Facades\Hash;

class AuthenticateVendorController extends Controller
{
    public function __construct(
        private VendorActions $vendorActions
    ) {
    }

    public function handle(AuthenticateVendorRequest $request)
    {
        $vendor = $this->vendorActions->getVendorByEmail(
            $request->email_address
        );
        if (is_null($vendor)) {
            throw new NotFoundException('Vendor record does not exist');
        }
        if (Hash::check($request->password, $vendor->password) === false) {
            throw new NotFoundException('Vendor record does not exist');
        }

        return successResponse(
            'Vendor account logged in successfully',
            200,
            [
                'access_token' => [
                    'type' => 'Bearer',
                    'token' => $vendor->createToken('Vendor AccessToken')->plainTextToken,
                ],
            ]
        );
    }
}
