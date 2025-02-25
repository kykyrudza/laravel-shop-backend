@extends('mail.email-layout.layout')

@section('title', 'Добро пожаловать!')

@section('content')
    <p>Здравствуйте, {{ $name }}!</p>
    <p>Вы успешно зарегистрировались в нашем сервисе.</p>
    <p>
        <a href="{{ url('/') }}" class="button">
            Перейти на сайт
        </a>
    </p>
@endsection
