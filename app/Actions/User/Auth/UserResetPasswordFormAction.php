<?php

namespace App\Actions\User\Auth;

use App\Exceptions\User\Auth\UserResetPasswordFormException;
use App\Services\User\Auth\UserResetPasswordFormService;

class UserResetPasswordFormAction
{
    public function __construct(
        protected UserResetPasswordFormService $service
    ) {
    }

    /**
     * @throws UserResetPasswordFormException
     */
    public function handle(array $data): true
    {
        return $this->service->handle($data);
    }
}
