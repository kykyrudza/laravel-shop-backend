<?php

namespace App\Http\Controllers\User\Auth;

use App\Actions\User\Auth\UserLoginAction;
use App\Actions\User\Auth\UserLogoutAction;
use App\Exceptions\User\Auth\UserLoginException;
use App\Exceptions\User\Auth\UserLogoutException;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\UserLoginRequest;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    public function index()
    {
        return view('user.auth.login');
    }

    public function store(UserLoginRequest $request, UserLoginAction $action)
    {
        try {
            $action->handle($request->validated());

            return redirect()
                ->route('home')
                ->with('success', __('success.auth.user-login.success'));

        } catch (UserLoginException $e) {

            return redirect()
                ->back()
                ->withErrors([
                    'error' => $e->getMessage(),
                ])
                ->withInput();

        }
    }

    public function logout(UserLogoutAction $action): RedirectResponse
    {
        try {
            $action->handle();

            return redirect()
                ->route('home')
                ->with('success', __('success.auth.user-logout.success'));

        } catch (UserLogoutException $e) {

            return redirect()
                ->back()
                ->withErrors([
                    'error' => $e->getMessage(),
                ])
                ->withInput();

        }
    }
}
