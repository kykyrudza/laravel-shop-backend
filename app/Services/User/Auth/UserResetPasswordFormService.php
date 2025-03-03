<?php

namespace App\Services\User\Auth;

use App\Exceptions\User\Auth\UserResetPasswordFormException;
use App\Models\User;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class UserResetPasswordFormService
{
    public function __construct(
        protected UserRepository $repository,
    ) {
    }

    /**
     * @throws UserResetPasswordFormException
     */
    public function handle(array $data): true
    {
        try {
            $status = $this->resetPassword($data);
            if ($status !== Password::PASSWORD_RESET) {
                throw new UserResetPasswordFormException(__('errors.auth.reset-password-form.token-error'));
            }

            return true;
        } catch (UserResetPasswordFormException $e) {
            throw new UserResetPasswordFormException(
                $e->getMessage(),
                0,
                $e
            );
        }
    }

    private function resetPassword(array $data): string
    {
        return Password::reset(
            $this->getResetData($data),
            fn (User $user, string $password) => $this->updateUserPassword($user, $password)
        );
    }

    private function updateUserPassword(User $user, string $password): void
    {
        $user->forceFill([
            'password' => Hash::make($password),
        ])->setRememberToken(Str::random(60));

        $user->save();
    }

    private function getResetData(array $data): array
    {
        return [
            'email' => $data['email'],
            'password' => $data['password'],
            'password_confirmation' => $data['password_confirmation'],
            'token' => $data['token'],
        ];
    }
}
