<x-mail::message>
# OTP Code Verification

Below is your account activation code.

<p>Your OTP code is: {{ $otp->token }}</p>

Expires in : {{$otp->expires_at->diffForHumans();}}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
