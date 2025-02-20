<?php

namespace App\Actions\User\Auth;

use App\Exceptions\User\Auth\UserRegisterException;
use App\Services\User\Auth\UserRegisterService;
use Throwable;

class UserRegisterAction
{
    protected UserRegisterService $service;

    public function __construct(UserRegisterService $service)
    {
        $this->service = $service;
    }

    /**
     * @throws UserRegisterException
     */
    public function handle(array $data)
    {
        try {
            return $this->service->register($data);
        } catch (Throwable $e) {
            report($e);
            throw new UserRegisterException($e->getMessage(), 0, $e);
        }
    }
}
