<?php

namespace App\Http\Controllers\User\Auth;

use App\Actions\User\Auth\UserResetPasswordFormAction;
use App\Exceptions\User\Auth\UserResetPasswordFormException;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\UserResetPasswordFormRequest;

class ResetPasswordController extends Controller
{
    public function index()
    {
        return view('user.auth.password.password_reset_form');
    }

    public function store(UserResetPasswordFormRequest $request, UserResetPasswordFormAction $action)
    {
        try {
            $action->handle($request->validated());

            return redirect()
                ->route('login')
                ->with('success', 'Password change success');

        }catch (UserResetPasswordFormException $e){
            return redirect()
                ->back()
                ->withErrors([
                    'error' => $e->getMessage(),
                ]);

        }
    }
}
