@extends('mail.email-layout.layout')

@section('title', 'Успешный вход в аккаунт')

@section('content')
    <p>Здравствуйте, {{ $name }}!</p>
    <p>Вы успешно вошли в свой аккаунт {{ $loginTime }}.</p>
    <p>Если это были не вы, пожалуйста, измените пароль.</p>
@endsection

@section('buttonText', 'Перейти в аккаунт')
@section('buttonUrl', url('/profile'))
