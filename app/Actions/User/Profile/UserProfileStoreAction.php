<?php

namespace App\Actions\User\Profile;

use App\Exceptions\User\Profile\UserProfileUpdateException;
use App\Services\User\Profile\UserProfileUpdateService;
use Throwable;

class UserProfileStoreAction
{
    public function __construct(
        protected UserProfileUpdateService $service,
    ) {}

    /**
     * @throws Throwable
     * @throws UserProfileUpdateException
     */
    public function handle(array $data): bool
    {
        return $this->service->handle($data);
    }
}
