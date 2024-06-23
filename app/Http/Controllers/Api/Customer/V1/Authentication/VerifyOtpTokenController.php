<?php


namespace App\Http\Controllers\Api\Customer\V1\Authentication;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Actions\CustomerActions;
use App\Actions\OtpTokenActions;
use App\Http\Controllers\Controller;
use App\Exceptions\NotFoundException;
use App\Exceptions\BadRequestException;


class VerifyOtpTokenController extends Controller 
{
    public function __construct(
        private CustomerActions $customerActions,
        private OtpTokenActions $otpTokenActions,
    ){}
    public function handle(Request $request)
    {

        $customer = $this->customerActions->getCustomerByEmail($request->email_address);

        $otpToken = $this->otpTokenActions->getOtpTokenRecord([
            'author_id' => $customer->id,
            'purpose' => 'customer-authentication'
        ]);

        if ($otpToken?->token !== $request->otp_token) {
            throw new NotFoundException('Otp token does not exist. Kindly request a new token');
        }

        if ($otpToken?->expires_at < Carbon::now()) {
            throw new BadRequestException('Otp token has expired. Kindly request a new token');
        }

        if (is_null($customer->email_address_verified_at)) {
            $this->customerActions->updateCustomerRecord([
                'update_payload' => [
                    'email_address_verified_at' => Carbon::now()
                ],
                'entity_id' => $customer->id
            ]);
        }
        
        $this->otpTokenActions->deleteOtpTokenRecord($otpToken->id);
        
        return successResponse(
            'Customer was verified successfully',
            201,
            $customer, 
        );
    }
}