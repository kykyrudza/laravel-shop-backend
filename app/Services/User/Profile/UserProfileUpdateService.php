<?php

namespace App\Services\User\Profile;

use App\Exceptions\User\Profile\UserProfileUpdateException;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\DB;
use Throwable;

class UserProfileUpdateService
{
    public function __construct(
        protected UserRepository $repository,
    ) {}

    /**
     * @throws UserProfileUpdateException
     * @throws Throwable
     */
    public function handle(array $data): bool
    {
        try {
            return DB::transaction(function () use ($data) {
                $user = auth()->user();

                return $this->repository->updateUser($user, $data);
            });
        } catch (Throwable $e) {
            throw new UserProfileUpdateException(__('errors.user.profile-update.general'), 0, $e);
        }
    }
}
