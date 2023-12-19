@vite(['resources/scss/app.scss', 'resources/scss/watchlist.scss', 'resources/scss/index.scss', 'resources/css/app.css', 'resources/js/app.js'])

    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
        <h1>Your Watchlist</h1>
        <div class="movies-list">
            <div class="inner">
                @foreach ($movies as $movie)
                    <div class="movie-container">
                            @if ($movie['watched'])
                            <button class="watchedButton watched" onclick="updateWatched({{$movie->id}}, this)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="26.846" viewBox="0 0 36 26.846">
                                    <path id="Icon_awesome-check" data-name="Icon awesome-check" d="M12.227,30.9.527,19.2a1.8,1.8,0,0,1,0-2.546L3.073,14.1a1.8,1.8,0,0,1,2.546,0L13.5,21.986,30.382,5.1a1.8,1.8,0,0,1,2.546,0L35.473,7.65a1.8,1.8,0,0,1,0,2.546l-20.7,20.7A1.8,1.8,0,0,1,12.227,30.9Z" transform="translate(0 -4.577)"/>
                                </svg>
                            </button>
                            @else
                            <button class="watchedButton" onclick="updateWatched({{$movie->id}}, this)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="26.846" viewBox="0 0 36 26.846">
                                    <path id="Icon_awesome-check" data-name="Icon awesome-check" d="M12.227,30.9.527,19.2a1.8,1.8,0,0,1,0-2.546L3.073,14.1a1.8,1.8,0,0,1,2.546,0L13.5,21.986,30.382,5.1a1.8,1.8,0,0,1,2.546,0L35.473,7.65a1.8,1.8,0,0,1,0,2.546l-20.7,20.7A1.8,1.8,0,0,1,12.227,30.9Z" transform="translate(0 -4.577)"/>
                                </svg>
                            </button>
                            @endif
                        <a class="poster">
                            <img
                                src="{{ 'https://image.tmdb.org/t/p/w500/'.$movie['poster_path'] }}"
                                alt="{{ 'Poster for '.$movie['title'] }}"
                            />
                        </a>
                        <div class="movie-info">
                            <h3 class="movie-title">{{ $movie->title }}</h3>
                            <div>
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="11.234" height="10.752"
                                         viewBox="0 0 11.234 10.752">
                                      <path id="Icon_awesome-star" data-name="Icon awesome-star"
                                            d="M6.456.373,5.085,3.153,2.017,3.6a.672.672,0,0,0-.372,1.146L3.865,6.91,3.34,9.965a.672.672,0,0,0,.974.708L7.058,9.23,9.8,10.673a.672.672,0,0,0,.974-.708L10.252,6.91l2.219-2.163A.672.672,0,0,0,12.1,3.6L9.032,3.153,7.661.373a.673.673,0,0,0-1.205,0Z"
                                            transform="translate(-1.441 0.001)" fill="#dba000"/>
                                    </svg>
                                </span>
                                <span>{{ $movie->rating }} | </span>
                                <span>{{ \Carbon\Carbon::parse($movie->date_of_release)->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <x-footer/>
    </main>
    <script>
        function updateWatched(movieId, button) {
            // Data to be sent in the request body
            const postData = {
                movieId: movieId,
            };

            //console.log(movieId);

            // Make the API request using fetch
            fetch(`/updateWatched`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify(postData),
            })
                .then(response => {
                    console.log('Response Status:', response.status);
                    return response.json();
                })
                .then(data => {
                    console.log('Success:', data);
                    if (button.classList.contains('watched')) {
                        button.classList.remove('watched');
                    } else {
                        button.classList.add('watched');
                    }
                    // Handle the response as needed
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Handle errors
                });
        }
    </script>
</body>
</html>
