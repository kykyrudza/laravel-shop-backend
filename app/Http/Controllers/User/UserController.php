<?php

namespace App\Http\Controllers\User;

use App\Actions\User\Profile\UserPasswordUpdateAction;
use App\Actions\User\Profile\UserProfileIndexAction;
use App\Actions\User\Profile\UserProfileStoreAction;
use App\Exceptions\User\Profile\UserNotFoundException;
use App\Exceptions\User\Profile\UserProfileUpdateException;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Profile\UserChangePasswordRequest;
use App\Http\Requests\User\Profile\UserProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(UserProfileIndexAction $action, int $id): View|RedirectResponse
    {
        try {

            return view('user.profile.index', [
                'user' => $action->handle($id),
            ]);

        } catch (UserNotFoundException $e) {

            return $this->redirectBackWithMessage('errors', $e->getMessage());
        }
    }

    public function store(UserProfileUpdateRequest $request, UserProfileStoreAction $action): RedirectResponse
    {
        try {
            $action->handle($request->validated());

            return $this->redirectToRouteWithMessage(
                'profile',
                'success',
                __('success.user.profile-update.success'),
                ['user_id' => auth()->user()->id]
            );

        } catch (UserProfileUpdateException $e) {

            return $this->redirectBackWithMessage('errors', $e->getMessage());

        }
    }

    public function password(UserChangePasswordRequest $request, UserPasswordUpdateAction $action): RedirectResponse
    {
        try {
            $action->handle($request->validated());

            return $this->redirectBackWithMessage('success', __('success.user.password-update.success'));

        } catch (UserProfileUpdateException $e) {

            return $this->redirectBackWithMessage('errors', $e->getMessage());

        }
    }
}
