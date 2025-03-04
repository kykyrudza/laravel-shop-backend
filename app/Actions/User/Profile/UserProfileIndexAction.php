<?php

namespace App\Actions\User\Profile;

use App\Exceptions\User\Profile\UserNotFoundException;
use App\Models\User;
use App\Repositories\User\UserRepository;

class UserProfileIndexAction
{
    public function __construct(
        protected UserRepository $repository,
    ) {
    }

    /**
     * @throws UserNotFoundException
     */
    public function handle(int $id): User
    {
        $user = $this->repository->findById($id);

        if (!$user) {
            throw new UserNotFoundException('User not found');
        }

        return $user;
    }
}
