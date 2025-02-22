<?php

namespace App\Actions\User\Auth;

use App\Exceptions\User\Auth\UserForgotPasswordEmailFormException;
use App\Services\User\Auth\UserForgotPasswordEmailFormService;

class UserForgotPasswordEmailFormAction
{
    protected UserForgotPasswordEmailFormService $service;

    public function __construct(UserForgotPasswordEmailFormService $service)
    {
        $this->service = $service;
    }

    /**
     * @throws UserForgotPasswordEmailFormException
     */
    public function handle(array $data): true
    {
        return $this->service->handle($data);
    }
}
