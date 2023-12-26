@vite(['resources/js/nav.js'])
<header class="header">
    <div class="logo-container">
        <a href="/"><img class="logo" src="{{ asset('movienight-logo.png') }}" alt="Movienight logo"></a>
    </div>
    <div class="nav-container">
        <nav class="nav">
            <ul class="nav-items">
                <li class="nav-item"><a class="search-item" id="searchItem">Search</a></li>
                <li class="nav-item"><a href="/">Trending movies</a></li>
                @auth
                <li class="nav-item"><a href="/watchlist">Your Watchlist</a></li>
                @endauth
                @guest
                <li class="nav-item"> <a class="login-button" href="/login">Log in</a></li>
                @else
                <li class="nav-item">
                    <a class="login-button" href="{{ route('logout') }}" id="loginSubmit">Log out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">
                        @csrf
                    </form>
                </li>
                @endguest
            </ul>
        </nav>
    </div>
    <div class="search-bar-container">
        @csrf
        <form method="get" class="searchForm" action="{{ route('search.index') }}" id="searchForm">
            <label class="label">
                <input class="searchbar" id="searchBar" type="text" name="query" placeholder="What are you searching for?">
            </label>
            <button class="searchbarButton" type="submit">Search</button>
        </form>
        {{-- <div class="suggestions-container" id="suggestions-container"></div> --}}
    </div>
</header>
