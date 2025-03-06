<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

abstract class Controller
{
    protected function redirectBackWithMessage(string $message_type, string $message): RedirectResponse
    {
        return back()->with($message_type, $message);
    }

    protected function redirectBackWithMessageWithInput(string $message_type, string $message): RedirectResponse
    {
        return redirect()->back()->with($message_type, $message)->withInput();
    }

    protected function redirectToRouteWithMessage(string $route, string $message_type, string $message, array $route_params = []): RedirectResponse
    {
        return redirect()->route($route, $route_params)->with($message_type, $message);
    }
}
