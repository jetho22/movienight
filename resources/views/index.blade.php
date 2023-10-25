@vite(['resources/scss/app.scss', 'resources/scss/index.scss', 'resources/css/app.css', 'resources/js/app.js'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="black">
        <title>Movienight</title>
        <meta name="description" content="Create watch lists for your movie nights">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    </head>
    <body class="background font-color">
        <main class="main">
            <x-navbar />
            <div class="page">
                <label class="label">
                    <input class="searchbar" type="text" placeholder="What are you searching for?">
                </label>
                <div class="genres">
                    <button onclick="handleGenreClick(this)" class="active">Alle</button>
                    <button onclick="handleGenreClick(this)">Horror</button>
                    <button onclick="handleGenreClick(this)">Action</button>
                    <button onclick="handleGenreClick(this)">Romance</button>
                    <button onclick="handleGenreClick(this)">Popular</button>
                    <button onclick="handleGenreClick(this)">Animation</button>
                    <button onclick="handleGenreClick(this)">Thriller</button>
                    <button onclick="handleGenreClick(this)">Comedy</button>
                    <button onclick="handleGenreClick(this)">Fantasy</button>
                </div>
            </div>
        </main>
    </body>
</html>
