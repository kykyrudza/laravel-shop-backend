<?php

namespace App\Actions\User\Auth;

use App\Exceptions\User\Auth\UserResetPasswordFormException;
use App\Services\User\Auth\UserResetPasswordFormService;

class UserResetPasswordFormAction
{
    protected UserResetPasswordFormService $service;

    public function __construct(UserResetPasswordFormService $service)
    {
        $this->service = $service;
    }

    /**
     * @throws UserResetPasswordFormException
     */
    public function handle(array $data): true
    {
        return $this->service->handle($data);
    }
}
