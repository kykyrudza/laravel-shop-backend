<?php

namespace App\Http\Controllers;

use App\Actions\App\LocaleAction;

class MainController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function locale(LocaleAction $action, $locale)
    {
        return $action->handle($locale);
    }
}
