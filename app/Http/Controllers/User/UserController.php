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
            report($e);

            return back()->with('error', $e->getMessage());
        }
    }

    public function store(UserProfileUpdateRequest $request, UserProfileStoreAction $action): RedirectResponse
    {
        try {
            if ($action->handle($request->validated())) {
                return to_route('profile', ['user_id' => auth()->id()])
                    ->with('success', __('success.user.profile-update.success'));
            }
        } catch (UserProfileUpdateException $e) {
            report($e);
        }

        return back()->with('error', __('error.user.profile-update.general'));
    }

    public function password(UserChangePasswordRequest $request, UserPasswordUpdateAction $action): RedirectResponse
    {
        try {
            if ($action->handle($request->validated())) {
                return back()->with('success', __('success.user.password-update.success'));
            }
        } catch (UserProfileUpdateException $e) {
            report($e);
        }

        return back()->with('error', __('errors.user.password-change'));
    }
}
