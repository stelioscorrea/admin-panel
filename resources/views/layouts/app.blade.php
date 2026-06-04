<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel')</title>
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">

        @include('layouts.partials.navbar')
        @include('layouts.partials.sidebar')

        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    @yield('content_header')
                </div>
            </div>
            <div class="app-content">
                <div class="container-fluid">

                    {{-- @yield('content') --}}
                    {{ $slot }}
                    @livewireScripts

                </div>
            </div>
        </main>

        @include('layouts.partials.footer')
    </div>
</body>

</html>