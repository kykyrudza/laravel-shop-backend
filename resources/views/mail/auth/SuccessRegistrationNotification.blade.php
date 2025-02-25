@extends('mail.email-layout.layout')

@section('title', 'Добро пожаловать!')

@section('content')
    <p>Здравствуйте, {{ $name }}!</p>
    <p>Вы успешно зарегистрировались в нашем сервисе.</p>
@endsection

@section('buttonText', 'Перейти на сайт')
@section('buttonUrl', url('/'))
