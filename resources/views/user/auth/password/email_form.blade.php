@extends('layout.app')

@section('content')

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

    <form action="{{ route('password.email') }}" method="POST" class="block">
        @csrf
        <div class="py-5 px-7 flex items-center justify-between max-w-md">
            <label for="email">Email:</label>
            <input class="border"  type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        <button type="submit">Отправить!</button>
    </form>
@endsection
