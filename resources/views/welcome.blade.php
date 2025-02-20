<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>
<body>

    @if (session('success'))
        <div>
            <strong class="text-green-500">{{ session('success') }}</strong>
        </div>
    @endif

    @if (session('error'))
        <div>
            <strong class="text-red-500">{{ session('error') }}</strong>
        </div>
    @endif
    @yield('content')
</body>
</html>
