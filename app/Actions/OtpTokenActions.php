<?php



namespace App\Actions;
use App\Models\OtpToken;

class OtpTokenActions 
{
    public function __construct(
        private OtpToken $otpToken,
    ){}

    public function createOtpTokenRecord($createOtpTokenRecordOptions)
    {
        $data = $createOtpTokenRecordOptions['create_payload'];
        return $this->otpToken->create($data);
    }

    public function getOtpTokenRecord($getOtpTokenRecordOptions)
    {
        $authorId = $getOtpTokenRecordOptions['author_id'];
        $purpose = $getOtpTokenRecordOptions['purpose'];

        return $this->otpToken->where([
            'author_id' => $authorId,
            'purpose' => $purpose
        ])->first();
    }

    public function getOtpRecordByTokenOptions($getOtpTokenRecordOptions)
    {
        $purpose = $getOtpTokenRecordOptions['purpose'];
        $otp_token = $getOtpTokenRecordOptions['otp_token'];
        return $this->otpToken->where([
            'token' => $otp_token,
            'purpose' => $purpose
        ])->first();
    }
    public function deleteOtpTokenRecord($id)
    {
        $this->otpToken->where([
            'id' => $id,
        ])->delete();
    }
}