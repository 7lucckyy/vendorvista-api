<?php

namespace App\Actions\Auth;

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
            throw new UnAuthorizedException('Access Denied', 403);
        }

        if (is_null($user->email_verified_at)) {
            throw new UnAuthorizedException('Email not verified', 403);
        }

        if (!$user->account_activated) {
            throw new UnAuthorizedException('Account not activated', 403);
        }
    }
}
