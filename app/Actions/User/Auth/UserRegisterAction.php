<?php

namespace App\Actions\User\Auth;

use App\Exceptions\User\Auth\UserRegisterException;
use App\Models\User;
use App\Services\User\Auth\UserRegisterService;

class UserRegisterAction
{
    public function __construct(
        protected UserRegisterService $service
    ) {
    }

    /**
     * @throws UserRegisterException
     */
    public function handle(array $data): User
    {
        return $this->service->register($data);
    }
}
