<?php

namespace App\Services\User\Auth;

use App\Events\User\Auth\UserRegistered;
use App\Exceptions\User\Auth\UserRegisterException;
use App\Models\User;
use App\Repositories\User\Auth\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UserRegisterService
{
    public function __construct(
        protected UserRepository $repository
    ) {}

    /**
     * @throws UserRegisterException
     */
    public function register(array $data): User
    {
        $this->checkIfUserExists($data['email']);

        try {
            return DB::transaction(function () use ($data) {
                $data['password'] = Hash::make($data['password']);

                $user = $this->createUser($data);

                event(new UserRegistered($user));

                $this->loginCreatedUser($user, $data);

                return $user;
            });
        } catch (Throwable $e) {
            report($e);
            throw new UserRegisterException('Error during user registration: '.$e->getMessage(), 0, $e);
        }
    }

    /**
     * @throws UserRegisterException
     */
    private function checkIfUserExists(string $email): void
    {
        if ($this->repository->exists($email)) {
            throw new UserRegisterException('User with this email address already exist!');
        }
    }

    private function createUser(array $data): User
    {
        return $this->repository->create($data);
    }

    private function loginCreatedUser(User $user, array $data): void
    {
        $remember = !empty($data['remember_token']);

        auth()->login($user, $remember);
    }
}
