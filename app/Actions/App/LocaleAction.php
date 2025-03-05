<?php

namespace App\Actions\App;

class LocaleAction
{
    public function handle(string $locale): bool
    {
        if (in_array($locale, config('locales.available_locales'))) {
            session(['locale' => $locale]);
            app()->setLocale($locale);

            return true;
        }

        return false;
    }
}
