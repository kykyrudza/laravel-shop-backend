<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
</head>
<body>
<div class="container">
    <h2>@yield('title')</h2>
    <p>@yield('content')</p>
    @if(isset($buttonText) && isset($buttonUrl))
        <p><a href="{{ $buttonUrl }}" class="button">{{ $buttonText }}</a></p>
    @endif
</div>
</body>
</html>
