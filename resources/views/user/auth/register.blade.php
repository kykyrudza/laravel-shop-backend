@extends('layout.app')

@section('content')
    <h2>Регистрация</h2>

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

    <form action="{{ route('register.store') }}" method="POST" class="block">
        @csrf
        <div class="by-5 px-7 flex items-center justify-between max-w-md">
            <label for="name">Имя:</label>
            <input class="border " type="text" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="py-5 px-7 flex items-center justify-between max-w-md">
            <label for="email">Email:</label>
            <input class="border"  type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="py-5 px-7 flex items-center justify-between max-w-md">
            <label for="phone">Телефон:</label>
            <input class="border"  type="tel" id="phone" name="phone" value="{{ old('phone') }}" required>
        </div>
        <div class="py-5 px-7 flex items-center justify-between max-w-md">
            <label for="password">Пароль:</label>
            <input class="border"  type="password" id="password" name="password" required>
        </div>
        <div class="py-5 px-7 flex items-center justify-between max-w-md">
            <label for="password_confirmation">Подтверждение пароля:</label>
            <input class="border"  type="password" id="password_confirmation" name="password_confirmation" required>
        </div>
        <div class="py-5 px-7 flex items-center justify-between max-w-md">
            <label for="remember_token">Запомнить меня:</label>
            <input type="checkbox" name="remember_token" value="1">
        </div>
        <button type="submit">Зарегистрироваться</button>
    </form>
@endsection
