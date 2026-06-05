<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'Admin Panel'))</title>
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>

<body class="login-page bg-body-secondary">
    <div class="login-box">
        {{ $slot }}
    </div>
</body>

</html>
