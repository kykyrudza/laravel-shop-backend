<?php

namespace App\Http\Controllers\User\Auth;

use App\Actions\User\Auth\UserRegisterAction;
use App\Exceptions\User\Auth\UserRegisterException;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\UserRegisterRequest;

class RegisterController extends Controller
{
    public function index()
    {
        return view('user.auth.register');
    }

    public function store(UserRegisterRequest $request, UserRegisterAction $action)
    {
        try {
            $action->handle($request->validated());

            return redirect()
                ->route('home')
                ->with('success', 'Аккаунт удачно создан!');

        } catch (UserRegisterException $e) {

            return redirect()
                ->back()
                ->withErrors([
                    'error' => $e->getMessage(),
                ])
                ->withInput();

        }
    }
}
