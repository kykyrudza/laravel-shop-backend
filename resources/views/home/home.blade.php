@extends('layout.app')

@section('content')

    <form action="{{ route('locale.change') }}" method="POST">
        @csrf
        <select name="locale" onchange="this.form.submit()">
            @foreach(config('locales.available_locales') as $locale)
                <option value="{{ $locale }}" {{ app()->getLocale() === $locale ? 'selected' : '' }}>
                    {{ __('app.languages.' . $locale) }}
                </option>
            @endforeach
        </select>
    </form>

    <h1>{{ __('messages.welcome') }}</h1>
    <p>{{ __('messages.hello') }}</p>


    <p>Old pass: $2y$12$0AH5CZ/YcJrF.S22ySKmb.6KFz0DIR5OWD0H.U.Vuqkmjtmg1tNt.</p>
    <p>New pass: $2y$12$4/HIMTgTk/jGkfNmZyyaN.8FlspsV2DBb.bPpYPkSGm1deGg53/ce</p>
@endsection
