<!DOCTYPE html>
<html class="h-full bg-gray-100" lang="ru">
<head>
    <meta charset="utf-8"/>
    <title>@yield('page_title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
    @yield('content')
</body>
</html>
