<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- @vite(['resources/css/admin.scss', 'resources/js/admin.js']) --}}

    <link rel="stylesheet" href="{{ asset('assets/admin-css.css').'?'.time() }}">
</head>
<body>
    <div class="auth-page">
        @yield('content')
    </div>
</body>
</html>
