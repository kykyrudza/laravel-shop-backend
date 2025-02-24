<?php

namespace App\Http\Controllers;

use App\Actions\App\LocaleAction;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function locale(LocaleAction $action, Request $request)
    {
        return $action->handle($request->input('locale'));
    }
}
