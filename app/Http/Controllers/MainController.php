<?php

namespace App\Http\Controllers;

use App\Actions\App\LocaleAction;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('home.home');
    }

    public function locale(LocaleAction $action, Request $request)
    {
        if ($action->handle($request->input('locale'))) {
            return back();
        }

        return $this->redirectToRouteWithMessage('home', 'errors', __('Locale not Found!'));
    }
}
