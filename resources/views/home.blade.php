@extends('welcome')

@section('content')

    @foreach (config('locales.available_locales') as $locale)
        @if ($locale !== app()->getLocale())
            <a href="{{ route('locale.change', ['locale' => $locale]) }}">
                {{ __('app.change_locales') . ' ' . __('app.languages.' . $locale) }}
            </a>
        @endif
    @endforeach

    <h1>{{ __('messages.welcome') }}</h1>
    <p>{{ __('messages.hello') }}</p>
@endsection
