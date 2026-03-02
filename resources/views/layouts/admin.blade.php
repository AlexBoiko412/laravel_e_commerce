<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    @vite(['resources/js/auth-frontend.js', 'resources/css/app.css'])
</head>
<body>
@include('partials.navbar')

<main>
    @yield('content')
</main>

</body>
</html>
