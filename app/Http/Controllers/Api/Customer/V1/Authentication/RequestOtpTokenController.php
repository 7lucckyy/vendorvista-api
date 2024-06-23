<?php

namespace App\Http\Controllers\Api\Customer\V1\Authentication;

use Carbon\Carbon;
use App\Mail\SendOtpMail;
use Illuminate\Http\Request;
use App\Actions\CustomerActions;
use App\Actions\OtpTokenActions;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Api\Customer\V1\Authentication\RequestOtpTokenRequest;

class RequestOtpTokenController extends Controller
{
    public function __construct(
        private OtpTokenActions $otpTokenActions,
        private CustomerActions $customerActions
    )
    {}

    public function handle(Request $request)
    {
        $customer = $this->customerActions->getCustomerByEmail($request->email_address);

        $otpToken = $this->otpTokenActions->getOtpTokenRecord([
            'author_id' => $customer->id,
            'purpose' => 'customer-authentication'
        ]);

        if (!is_null($otpToken)) {
            $this->otpTokenActions->deleteOtpTokenRecord($otpToken->id);
        }

        $otp = $this->otpTokenActions->createOtpTokenRecord([
            'create_payload' => [
                'purpose' => 'customer-authentication',
                'token' => generateRandomNumber(6),
                'author_id' => $customer->id,
                'expires_at' => Carbon::now()->addMinutes(10)
            ]
        ]);
        

        Mail::to($customer->email_address)->send(new SendOtpMail($otp));

        return successResponse(
            'Otp token was requested successfully',
            201,
        );
    }
}
