<?php

namespace App\Http\Controllers\User\Auth;

use App\Actions\User\Auth\UserForgotPasswordEmailFormAction;
use App\Exceptions\User\Auth\UserForgotPasswordEmailFormException;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\UserForgotPasswordEmailFormRequest;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('user.auth.password.email_form');
    }

    public function store(UserForgotPasswordEmailFormRequest $request, UserForgotPasswordEmailFormAction $action)
    {
        try {
            $action->handle($request->validated());

            return redirect()
                ->back()
                ->with('success', 'Mail send to you Email!')
                ->withInput();

        }catch (UserForgotPasswordEmailFormException $e){

            return redirect()
                ->back()
                ->withErrors([
                    'error' => $e->getMessage(),
                ])
                ->withInput();

        }
    }
}
