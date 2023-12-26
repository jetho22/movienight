@vite(['resources/scss/app.scss', 'resources/scss/index.scss', 'resources/scss/show.scss', 'resources/css/app.css', 'resources/js/show.js'])
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-csrf-token="{{ csrf_token() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="black">
    <title>Movienight | Movies</title>
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
    <x-navbar/>
    <div class="page">
        <div class="movie">
            <div class="movie-poster">
                <img
                    class="poster"
                    src="{{ 'https://image.tmdb.org/t/p/w500/'.$movie['poster_path'] }}"
                    alt="{{ 'Poster for '.$movie['title'] }}"
                />
            </div>
            <div class="inner">
                <div class="movie-info">
                    <h1 class="h1">{{ $movie['title'] }}</h1>
                    <div class="details">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="11.234" height="10.752"
                                 viewBox="0 0 11.234 10.752">
                              <path id="Icon_awesome-star" data-name="Icon awesome-star"
                                    d="M6.456.373,5.085,3.153,2.017,3.6a.672.672,0,0,0-.372,1.146L3.865,6.91,3.34,9.965a.672.672,0,0,0,.974.708L7.058,9.23,9.8,10.673a.672.672,0,0,0,.974-.708L10.252,6.91l2.219-2.163A.672.672,0,0,0,12.1,3.6L9.032,3.153,7.661.373a.673.673,0,0,0-1.205,0Z"
                                    transform="translate(-1.441 0.001)" fill="#dba000"/>
                            </svg>
                        </span>
                        <span>{{ $movie['vote_average'] }} | </span>
                        <span>{{ \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y') }}</span>
                        <div>
                             | @foreach($movie['genres'] as $genre)
                                {{ $genre['name'] }}@if(!$loop->last),
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @auth
                        @if ($usersMovies->contains('movie_id', $movie['id']))
                            <button class="added" form="{{ $movie['id'] }}"
                                data-movie-id="{{ $movie['id'] }}" data-title="{{ $movie['title'] }}"
                                data-vote-average="{{ $movie['vote_average'] }}"
                                data-release-date="{{ $movie['release_date'] }}"
                                data-poster-path="{{ $movie['poster_path'] }}">
                                On your watchlist
                            </button>
                        @else
                            <button class="addButton" form="{{ $movie['id'] }}" data-movie-id="{{ $movie['id'] }}"
                                data-title="{{ $movie['title'] }}"
                                data-vote-average="{{ $movie['vote_average'] }}"
                                data-release-date="{{ $movie['release_date'] }}"
                                data-poster-path="{{ $movie['poster_path'] }}"
                                id="addButton">
                                Add to watchlist
                            </button>
                        @endif
                    @endauth
                    @if (count($movie['videos']['results']) > 0)
                        <div class="movie-trailer">
                            <a href="https://youtube.com/watch?v={{ $movie['videos']['results'][0]['key'] }}" target="_blank">Play trailer</a>
                        </div>
                    @endif
                    <p>{{ $movie['overview'] }}</p>
                    <h2>Featured cast</h2>
                    <div class="featured-cast">
                        @foreach ($movie['credits']['cast'] as $cast)
                            @if($loop->index < 5)
                            <div class="cast">
                                <div><strong>{{ $cast['name'] }}</strong></div>
                                <div>{{ $cast['character'] }}</div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-footer/>
</main>
</body>
</html>
