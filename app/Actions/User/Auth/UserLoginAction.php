<?php

namespace App\Actions\User\Auth;

use App\Exceptions\User\Auth\UserLoginException;
use App\Models\User;
use App\Services\User\Auth\UserLoginService;

class UserLoginAction
{
    public function __construct(
        protected UserLoginService $service,
    ) {
    }

    /**
     * @throws UserLoginException
     */
    public function handle(array $data): User
    {
        return $this->service->login($data);
    }
}
