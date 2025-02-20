<?php

namespace App\Services\User\Auth;

use App\Exceptions\User\Auth\UserLoginException;
use App\Models\User;
use App\Repositories\User\Auth\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class UserLoginService
{
    public function __construct(
        protected UserRepository $repository,
    ) {}

    /**
     * @throws UserLoginException
     */
    public function login(array $data): User
    {
        try {
            return DB::transaction(function () use ($data) {
                $user = $this->findUser($data['email']);

                if (!$user || !$this->attemptUser($user, $data['password'])) {
                    session()
                        ->flash(
                            'error',
                            'Invalid login credentials!'
                        );
                    throw new UserLoginException('Invalid login credentials!');
                }

                return $user;
            });
        } catch (Throwable $e) {
            report($e);
            throw new UserLoginException(
                'Error during user login: ' . $e->getMessage(),
                0,
                $e
            );
        }
    }

    private function findUser(string $email): ?User
    {
        return $this->repository->find($email);
    }

    private function attemptUser(User $user, string $password): bool
    {
        return Auth::attempt(['email' => $user->email, 'password' => $password]);
    }
}
