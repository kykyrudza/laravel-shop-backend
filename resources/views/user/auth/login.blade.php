@extends('layout.app')

@section('content')
    <h2>Вход</h2>

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

    <form action="{{ route('login.store') }}" method="POST" class="block">
        @csrf
        <div class="py-5 px-7 flex items-center justify-between max-w-md">
            <label for="email">Email:</label>
            <input class="border"  type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="py-5 px-7 flex items-center justify-between max-w-md">
            <label for="password">Пароль:</label>
            <input class="border"  type="password" id="password" name="password" required>
        </div>
        <button type="submit">Войти!</button>
    </form>
@endsection
