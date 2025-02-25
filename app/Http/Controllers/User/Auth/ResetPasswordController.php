<?php

namespace App\Http\Controllers\User\Auth;

use App\Actions\User\Auth\UserResetPasswordFormAction;
use App\Exceptions\User\Auth\UserResetPasswordFormException;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\UserResetPasswordFormRequest;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function index(Request $request, string $token)
    {
        return view('user.auth.password.password_reset_form', [
            'token' => $token,
            'email' => $request->query('email')
        ]);
    }


    public function store(UserResetPasswordFormRequest $request, UserResetPasswordFormAction $action)
    {
        try {
            $action->handle($request->validated());

            return redirect()
                ->route('login')
                ->with('success', __('success.auth.reset-password.success'));

        } catch (UserResetPasswordFormException $e) {
            return redirect()
                ->back()
                ->withErrors([
                    'error' => $e->getMessage(),
                ]);

        }
    }
}
