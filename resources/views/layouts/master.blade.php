<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-inverse navbar-fixed-top justify-content-between">
            <a class="mr-auto" href="{{ route('home') }}">Главная</a>
            @auth
                <a class="mr-auto" href="{{ route('dashboard') }}">Дашборд</a>
            @endauth

            <div class="d-flex">
                @guest
                    <a class="nav-link" href="{{ route('show-login') }}">Login</a>
                    <a class="nav-link" href="{{ route('show-registration') }}">Register</a>
                @else
                    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                @endguest
            </div>
        </nav>
    </div>


<div class="container">
    <div class="starter-template">
        @if(session()->has('success'))
            <p class="alert alert-success">{{ session()->get('success') }}</p>
        @endif
        @if(session()->has('warning'))
            <p class="alert alert-warning">{{ session()->get('warning') }}</p>
        @endif
        @yield('content')
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
