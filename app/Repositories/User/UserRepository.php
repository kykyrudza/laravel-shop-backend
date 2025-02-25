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
}
