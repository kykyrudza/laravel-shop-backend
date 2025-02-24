@extends('welcome')

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
@endsection
