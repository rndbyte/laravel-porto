<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <title>@yield('page_title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{!! asset('favicon.ico') !!}">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @routes
</head>
<body class="h-full bg-gray-100 leading-none">
    @yield('content')
</body>
</html>
