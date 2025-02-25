<?php

namespace App\Actions\User\Auth;

use App\Exceptions\User\Auth\UserLogoutException;
use Throwable;

class UserLogoutAction
{
    /**
     * @throws UserLogoutException
     */
    public function handle(): void
    {
        try {

            auth()->logout();

            $this->restoreSession();

        } catch (Throwable $e) {

            throw new UserLogoutException(
                __('errors.auth.user-logout.error'),
                0,
                $e
            );

        }
    }

    private function restoreSession(): void
    {
        session()->regenerate();
        session()->regenerateToken();
    }
}
