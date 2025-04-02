<?php

namespace App\Actions\Access;

use App\Exceptions\UnAuthorizedException;

class VendorAccessActions 
{
    /**
     * Execute the vendor access validation.
     *
     * @param  mixed  $user
     * @return void
     * @throws UnAuthorizedException
     */
    public function execute($user): void
    {
        if ($user->user_type !== 'vendor') {
            throw new UnAuthorizedException('Access Denied', 403);
        }
        if (empty($user->email_address_verified_at)) {
            throw new UnAuthorizedException('Email not verified. Kindly verify your email address.', 403);
        }
        
        if (!$user->account_activated) {
            throw new UnAuthorizedException('Account not activated', 403);
        }
    }
}