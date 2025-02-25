<?php

namespace App\Services\User\Auth;

use App\Events\User\Auth\ResetPasswordEmail;
use App\Exceptions\User\Auth\UserForgotPasswordEmailFormException;
use App\Models\User;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Password;

class UserForgotPasswordEmailFormService
{
    public function __construct(
        protected UserRepository $repository,
    ) {}

    /**
     * @throws UserForgotPasswordEmailFormException
     */
    public function handle(array $data): true
    {
        try {
            $user = $this->findUser($data['email']);

            if (! $user) {
                throw new UserForgotPasswordEmailFormException(__('errors.auth.forgot-password-form.user-not-found'));
            }

            $token = Password::getRepository()->create($user);

            event(new ResetPasswordEmail($user, $token));

            return true;
        } catch (UserForgotPasswordEmailFormException $e) {
            throw new UserForgotPasswordEmailFormException(
                $e->getMessage(),
                0,
                $e
            );
        }
    }

    private function findUser(string $email): User|false
    {
        return $this->repository->find($email) ?? false;
    }
}
