<?php

namespace App\Services\User\Profile;

use App\Exceptions\User\Profile\UserProfileUpdateException;
use App\Repositories\User\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Throwable;

class UserProfileUpdateService
{
    public function __construct(
        protected UserRepository $repository,
    ){}

    /**
     * @param array $data
     * @return RedirectResponse
     * @throws UserProfileUpdateException
     * @throws Throwable
     */
    public function handle(array $data): RedirectResponse
    {
        try {
            return DB::transaction(function () use ($data) {
                $user = auth()->user();

                if ($this->repository->updateUser($user, $data)) {
                    session()->flash('success', __('success.user.profile-update.success'));
                } else {
                    session()->flash('error', __('error.user.profile-update.error'));
                }

                return $this->redirect($user->id);
            });
        } catch (Throwable $e) {
            logger()->error('User profile update error', ['error' => $e]);

            session()->flash('error', __('error.user.profile-update.general'));

            throw new UserProfileUpdateException(__('error.user.profile-update.error'), 0, $e);
        }
    }

    /**
     * @param int $user_id
     * @return RedirectResponse
     */
    private function redirect(int $user_id): RedirectResponse
    {
        return to_route('profile', [
            'user_id' => $user_id,
        ]);
    }
}
