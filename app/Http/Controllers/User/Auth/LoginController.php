<?php

namespace App\Http\Controllers\User\Auth;

use App\Actions\User\Auth\UserLoginAction;
use App\Exceptions\User\Auth\UserLoginException;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\UserLoginRequest;

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
                ->with('success', 'Вы успешно вошли в аккаунт!');

        } catch (UserLoginException $e) {

            return redirect()
                ->back()
                ->withErrors([
                    'error' => $e->getMessage(),
                ])
                ->withInput();

        }
    }
}
