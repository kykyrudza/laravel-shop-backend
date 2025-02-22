<?php

namespace App\Services\User\Auth;

use App\Exceptions\User\Auth\UserResetPasswordFormException;
use App\Repositories\User\Auth\UserRepository;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Str;

class UserResetPasswordFormService
{
    public function __construct(
        protected UserRepository $repository,
    ) {}

    /**
     * @throws UserResetPasswordFormException
     */
    public function handle(array $data): true
    {
        try {
            $status = $this->resetPassword($data);

            if ($status !== Password::PASSWORD_RESET) {
                throw new UserResetPasswordFormException('Неверный или устаревший токен.');
            }

            return true;
        } catch (Exception $e) {
            report($e);
            throw new UserResetPasswordFormException('Ошибка при сбросе пароля.');
        }
    }

    private function resetPassword(array $data): string
    {
        return Password::reset(
            $this->getResetData($data),
            fn(User $user, string $password) => $this->updateUserPassword($user, $password)
        );
    }

    private function updateUserPassword(User $user, string $password): void
    {
        $user->forceFill([
            'password' => Hash::make($password)
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
