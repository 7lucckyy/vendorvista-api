<?php

namespace App\Http\Controllers\Api\Customer\V1\Authentication\ResetPasswordOtp;

use Carbon\Carbon;
use App\Mail\SendOtpMail;
use Illuminate\Http\Request;
use App\Actions\CustomerActions;
use App\Actions\OtpTokenActions;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ResetPasswordOtpRequestController extends Controller
{
    public function __construct(
        private OtpTokenActions $otpTokenActions,
        private CustomerActions $customerActions
    )
    {}

    public function handle(Request $request)
    {
        $email = $request->get('email');

        $customer = $this->customerActions->getCustomerByEmail($email);

        if(is_null($customer)){
            return errorResponse('email address not found ', 400);
        }

        $otpToken = $this->otpTokenActions->getOtpTokenRecord([
            'author_id' => $customer->id,
            'purpose' => 'password_reset'
        ]);

        if (!is_null($otpToken)) {
            $this->otpTokenActions->deleteOtpTokenRecord($otpToken->id);
        }

        $otp = $this->otpTokenActions->createOtpTokenRecord([
            'create_payload' => [
                'purpose' => 'password_reset',
                'token' => generateRandomNumber(6),
                'author_id' => $customer->id,
                'expires_at' => Carbon::now()->addMinutes(10)
            ]
        ]);
        

        Mail::to($customer->email_address)->send(new SendOtpMail($otp));

        return successResponse(
            'Otp token was requested successfully',
            200,
        );
    }
}
