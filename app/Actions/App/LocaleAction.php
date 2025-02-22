<?php

namespace App\Actions\App;

use Illuminate\Http\RedirectResponse;

class LocaleAction
{
    public function handle(string $locale): RedirectResponse
    {
        if (in_array($locale, config('locales.available_locales'))) {
            session(['locale' => $locale]);
            app()->setLocale($locale);
            return redirect()->route('home');
        }

        return redirect()->route('home')->with('error', 'locale not found');
    }
}
