<?php

namespace App\Actions\User\Profile;

use App\Exceptions\User\Profile\UserProfileUpdateException;
use App\Repositories\User\UserRepository;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class UserPasswordUpdateAction
{
    public function __construct(
        protected UserRepository $repository,
    ){}

    /**
     * @throws UserProfileUpdateException
     */
    public function handle(array $data): RedirectResponse
    {
        if (!$this->repository->checkingForMatchingPasswords($data['current_password'])) {
            session()->flash('error', __('errors.user.password-change'));
            return back();
        }

        try {
            $this->repository->updateUserPassword($data['password']);

            session()->flash('success', __('success.user.password-update.success'));

        }catch (Exception $e){
            Log::error('Ошибка смены пароля: ' . $e->getMessage());

            throw new UserProfileUpdateException(
                __('errors.user.password-change'),
                500,
                $e
            );
        }

        return back();
    }
}
