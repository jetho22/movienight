@vite(['resources/scss/app.scss', 'resources/js/app.js'])
@vite(['resources/css/app.css', 'resources/js/app.js'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Movienight</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    </head>
    <body class="background font-color">
        <main class="main">
            <header class="header">
                <div class="nav-container">
                    <img class="logo" src="{{ asset('movienight-logo.png') }}" alt="Movienight logo">
                    <nav class="nav">
                        <ul class="nav-items">
                            <li class="nav-item">Watchlist</li>
                            <li class="nav-item">Series</li>
                            <li class="nav-item">Films</li>
                        </ul>
                    </nav>
                </div>
                <div>
                    Log ind
                </div>
            </header>
        </main>
    </body>
</html>
