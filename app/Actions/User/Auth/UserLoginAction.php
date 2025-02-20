<?php

namespace App\Actions\User\Auth;

use App\Exceptions\User\Auth\UserLoginException;
use App\Services\User\Auth\UserLoginService;
use Throwable;

class UserLoginAction
{
    public function __construct(
        protected UserLoginService $service,
    ) {}

    /**
     * @throws UserLoginException
     */
    public function handle(array $data)
    {
        try {
            return $this->service->login($data);
        } catch (Throwable $e) {
            report($e);
            throw new UserLoginException($e->getMessage(), 0, $e);
        }
    }
}
