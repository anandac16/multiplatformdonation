<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
            <div class="container">
                <a class="navbar-brand" href="#">Donasi Dashboard</a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ms-auto">
                        @if(session('user_uuid'))
                            <li class="nav-item"><a href="/tokens/{{ session('user_uuid') }}" class="nav-link">Tokens</a></li>
                            <li class="nav-item"><a href="/overlays/milestone" class="nav-link">Milestone</a></li>
                            <li class="nav-item"><a href="/overlays/leaderboard" class="nav-link">Leaderboard</a></li>
                            <li class="nav-item"><a href="/donations" class="nav-link">Donation History</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
