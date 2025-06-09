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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
            <div class="container">
                <a class="navbar-brand" href="{{ route('dashboard') }}">Donasi Dashboard</a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a href="/howto" class="nav-link">How to</a></li>
                        <li class="nav-item"><a href="/tokens/{{ session('user_uuid') }}" class="nav-link">Tokens</a></li>
                        @if(!session('user_uuid'))
                            <li class="nav-item"><a href="/connect" class="nav-link">Connect</a></li>
                        @endif
                        @if(session('user_uuid'))
                            <li class="nav-item"><a href="/overlays/milestone" class="nav-link">Milestone</a></li>
                            <li class="nav-item"><a href="/overlays/leaderboard" class="nav-link">Leaderboard</a></li>
                            <li class="nav-item"><a href="/donations" class="nav-link">Donation History</a></li>
                        @endif
                        @auth
                            <li class="nav-item"><a href="/monitor" class="nav-link">Monitor</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <footer style="background:#5a5959; color:#fff; padding:10px; display:flex; justify-content:space-between; align-items:center; font-family:sans-serif;">
        <div style="display: flex; align-items: center; gap: 20px;">
            <span>Find me:</span>
            <a href="https://www.facebook.com/achannnnnnnnnn" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="https://x.com/Achandesu_" target="_blank"><i class="fab fa-x-twitter"></i></a>
        </div>

        <div>
            <!-- Trakteer button embed -->
            <script type='text/javascript' src='https://edge-cdn.trakteer.id/js/embed/trbtn.min.js?v=14-05-2025'></script><script type='text/javascript'>(function(){var trbtnId=trbtn.init('Buy me coffee','#E91E63','https://trakteer.id/achanch','https://trakteer.id/images/mix/coffee.png','40');trbtn.draw(trbtnId);})();</script>
        </div>
    </footer>

</body>
</html>
