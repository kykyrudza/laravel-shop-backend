<?php

namespace App\Http\Controllers\User;

use App\Actions\User\Profile\UserPasswordUpdateAction;
use App\Actions\User\Profile\UserProfileIndexAction;
use App\Actions\User\Profile\UserProfileStoreAction;
use App\Exceptions\User\Profile\UserProfileUpdateException;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Profile\UserChangePasswordRequest;
use App\Http\Requests\User\Profile\UserProfileUpdateRequest;
use Throwable;

class UserController extends Controller
{
    public function index(UserProfileIndexAction $action, int $id)
    {
        return $action->handle($id);
    }

    /**
     * @throws Throwable
     * @throws UserProfileUpdateException
     */
    public function store(UserProfileUpdateRequest $request, UserProfileStoreAction $action)
    {
        return $action->handle($request->validated());
    }

    /**
     * @throws UserProfileUpdateException
     */
    public function password(UserChangePasswordRequest $request, UserPasswordUpdateAction $action)
    {
        return $action->handle($request->validated());
    }
}
