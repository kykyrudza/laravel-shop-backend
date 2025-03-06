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

            return $this->redirectToRouteWithMessage('home', 'success',  __('success.auth.user-register.success'));

        } catch (UserRegisterException $e) {

            return $this->redirectBackWithMessageWithInput('errors', $e->getMessage());

        }
    }
}
