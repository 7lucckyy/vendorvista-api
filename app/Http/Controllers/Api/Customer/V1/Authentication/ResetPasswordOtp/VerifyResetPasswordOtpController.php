<?php


namespace App\Http\Controllers\Api\Customer\V1\Authentication\ResetPasswordOtp;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Actions\CustomerActions;
use App\Actions\OtpTokenActions;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\NotFoundException;
use App\Exceptions\BadRequestException;


class VerifyResetPasswordOtpController extends Controller 
{
    public function __construct(
        private CustomerActions $customerActions,
        private OtpTokenActions $otpTokenActions,
    ){}
    public function handle(Request $request)
    {

        $otp = $request->get('otp_token');
        $newPassword = $request->get('password');


        $otpToken = $this->otpTokenActions->getOtpRecordByTokenOptions([
             'otp_token' => $otp,
            'purpose' => 'password_reset'
        ]);

        $customerId = $otpToken->author_id;

        $customer = $this->customerActions->getCustomerById($customerId);

        if ($otpToken?->token !== $request->otp_token) {
            throw new NotFoundException('Otp token does not exist. Kindly request a new token');
        }

        if ($otpToken?->expires_at < Carbon::now()) {
            throw new BadRequestException('Otp token has expired, Kindly request a new token');
        }

        if (is_null($customer->email_address_verified_at)) {
            $this->customerActions->updateCustomerRecord([
                'update_payload' => [
                    'email_address_verified_at' => Carbon::now(),
                    'password' => Hash::make($newPassword),
                ],
                'customer_id' => $customer->id
            ]);
        }
        
        $this->otpTokenActions->deleteOtpTokenRecord($otpToken->id);
        
        return successResponse(
            'Password reset successfully',
            200,
            $customer, 
        );
    }
}