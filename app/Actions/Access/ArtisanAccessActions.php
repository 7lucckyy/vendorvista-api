<?php

namespace App\Actions\Access;

use App\Exceptions\UnAuthorizedException;

class ArtisanAccessActions
{
    /**
     * Execute the artisan access validation.
     *
     * @param  mixed  $user
     * @return void
     * @throws UnAuthorizedException
     */
    public function execute($user): void
    {
        if ($user->user_type !== 'artisan') {
            throw new UnAuthorizedException('Access Denied');
        }
        if (empty($user->email_address_verified_at)) {
            throw new UnAuthorizedException('Email not verified. Kindly verify your email address.');
        }
        

        if (!$user->account_activated) {
            throw new UnAuthorizedException('Account not activated');
        }
    }
}
