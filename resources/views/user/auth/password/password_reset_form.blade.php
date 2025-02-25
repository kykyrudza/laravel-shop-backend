@extends('layout.app')

@section('content')
    <h2>Смена пароля</h2>

    @if ($errors->any())
        <div>
            <strong>Ошибки:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('password.update') }}" method="POST">
        @csrf

        <!-- Токен сброса пароля -->
        <input type="hidden" name="token" value="{{ $token }}">

        <!-- Email пользователя (из URL) -->
        <input type="email" name="email" value="{{ $email }}" required readonly>

        <!-- Новый пароль -->
        <input type="password" name="password" required>

        <!-- Подтверждение пароля -->
        <input type="password" name="password_confirmation" required>

        <button type="submit">Сменить пароль</button>
    </form>

@endsection
