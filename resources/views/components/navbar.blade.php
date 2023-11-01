<header class="header">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <div class="logo-container">
        <a href="/"><img class="logo" src="{{ asset('movienight-logo.png') }}" alt="Movienight logo"></a>
    </div>
    <div class="nav-container">
        <nav class="nav">
            <ul class="nav-items">
                <li class="nav-item"><a href="/">Movies</a></li>
                @auth
                <li class="nav-item"><a href="/watchlist">Your Watchlist</a></li>
                @endauth
                @guest
                <li class="nav-item"> <a class="login-button" href="/login">Log in</a></li>
                @else
                <li class="nav-item">
                    <a class="login-button" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();"
                    >Log out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">
                        @csrf
                    </form>
                </li>
                @endguest
            </ul>
        </nav>
    </div>
</header>
