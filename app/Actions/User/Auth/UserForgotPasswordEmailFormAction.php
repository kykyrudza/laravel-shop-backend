<?php

namespace App\Actions\User\Auth;

use App\Exceptions\User\Auth\UserForgotPasswordEmailFormException;
use App\Services\User\Auth\UserForgotPasswordEmailFormService;

class UserForgotPasswordEmailFormAction
{
    public function __construct(
        protected UserForgotPasswordEmailFormService $service
    ) {}

    /**
     * @throws UserForgotPasswordEmailFormException
     */
    public function handle(array $data): bool
    {
        return $this->service->handle($data);
    }
}
