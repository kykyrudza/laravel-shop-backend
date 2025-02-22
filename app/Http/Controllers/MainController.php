<?php

namespace App\Http\Controllers;

use App\Actions\App\LocaleAction;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request)
    {
        return view('home');
    }

    public function changeLocale(LocaleAction $action, $locale)
    {
       return $action->handle($locale);
    }
}
