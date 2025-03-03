<?php

namespace App\Actions\User\Profile;

use App\Exceptions\User\Profile\UserProfileUpdateException;
use App\Services\User\Profile\UserProfileUpdateService;
use Illuminate\Http\RedirectResponse;
use Throwable;

class UserProfileStoreAction
{
    public function __construct(
        protected UserProfileUpdateService $service,
    ) {
    }

    /**
     * @throws Throwable
     * @throws UserProfileUpdateException
     */
    public function handle(array $data): RedirectResponse
    {
        return $this->service->handle($data);
    }
}
