@vite(['resources/scss/app.scss', 'resources/scss/watchlist.scss', 'resources/scss/index.scss', 'resources/css/app.css', 'resources/js/app.js', 'resources/js/watchlist.js'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-csrf-token="{{ csrf_token() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="black">
    <title>Movienight | Watchlist</title>
    <meta name="description" content="Create watch lists for your movie nights">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
</head>
<body class="background font-color">
<main class="main">
    <x-navbar />
    <h1>Other Users' Watchlists</h1>
    <div class="users-watchlists">
        @foreach ($watchlists as $user)
        @if ($user->role !== 'admin')
        <div class="user-watchlist">
            <h2>{{ $user->name }}'s Watchlist</h2>
            <ul>
                @foreach ($user->movies as $movie)
                <li>
                    <h3>{{ $movie->title }}</h3>
                    <form action="{{ route('admin.remove-movie', ['user' => $user->id, 'movie' => $movie->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Remove</button>
                    </form>
                </li>
                @endforeach
            </ul>
        </div>
        @endif
        @endforeach
    </div>
    <x-footer/>
</main>
</body>
</html>
