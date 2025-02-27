<?php

namespace App\Repositories\User;

use App\Models\User;

class UserRepository
{
    public function create(array $data): User
    {
        return User::query()
            ->create($data);
    }

    public function exists(string $email): bool
    {
        return User::query()
            ->where('email', $email)
            ->exists();
    }

    public function find(string $email): User|false
    {
        return User::query()
            ->where([
                'email' => $email,
            ])->first() ?? false;
    }

    public function findById(int $id): User|false
    {
        return User::query()
            ->where([
                'id' => $id,
            ])->first() ?? false;
    }

    public function updateUser(User $user, array $data): bool
    {
        return $user->update($data);
    }
}
