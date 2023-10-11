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

    <script>
        var toggle = false;
        function handleToggle() {
            toggle = !toggle;
            console.log(toggle)
        }
    </script>
</head>
<body class="background font-color">
<main class="main">
    <x-navbar />
    <h1>Watchlist page</h1>
</main>
</body>
</html>
