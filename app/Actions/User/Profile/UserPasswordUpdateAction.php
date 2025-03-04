<?php

namespace App\Actions\User\Profile;

use App\Exceptions\User\Profile\UserProfileUpdateException;
use App\Repositories\User\UserRepository;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class UserPasswordUpdateAction
{
    public function __construct(protected UserRepository $repository) {}

    /**
     * @throws UserProfileUpdateException
     */
    public function handle(array $data): bool
    {
        if (!$this->repository->checkingForMatchingPasswords($data['current_password'])) {
            return false;
        }

        try {
            return $this->repository->updateUserPassword($data['password']);
        } catch (Exception $e) {
            Log::error('Ошибка смены пароля: ' . $e->getMessage());
            throw new UserProfileUpdateException(__('errors.user.password-change'), 500, $e);
        }
    }
}
