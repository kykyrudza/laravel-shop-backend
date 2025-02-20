<?php

namespace App\Services\User\Auth;

use App\Events\User\Auth\UserRegistered;
use App\Exceptions\User\Auth\UserRegisterException;
use App\Repositories\User\Auth\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Throwable;

class UserRegisterService
{
    protected UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws UserRegisterException
     */
    public function register(array $data)
    {
        if ($this->repository->exists($data['email'])) {
            throw new UserRegisterException('Пользователь с таким email уже существует.');
        }

        try {
            return DB::transaction(function () use ($data) {
                $data['password'] = Hash::make($data['password']);

                $remember = !empty($data['remember_token']);

                $user = $this->repository->create($data);

                auth()->login($user, $remember);

                event(new UserRegistered($user));

                return $user;
            });
        } catch (Throwable $e) {
            report($e);
            throw new UserRegisterException($e->getMessage());
        }
    }
}
