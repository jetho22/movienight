@vite(['resources/js/nav.js'])
<header class="header">
    <div class="logo-container">
        <a href="/"><img class="logo" src="{{ asset('movienight-logo.png') }}" alt="Movienight logo"></a>
    </div>
    <div class="nav-container">
        <nav class="nav">
            <ul class="nav-items">
                <li class="nav-item"><a href="/">Movies</a></li>
                @auth
                @if (Auth::user()->role == 'admin')
                <li class="nav-item"><a href="{{ route('admin.watchlists.index') }}">Other Users Watchlists</a></li>
                @else
                <li class="nav-item"><a href="{{ route('watchlist') }}">Your Watchlist</a></li>
                @endif
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
</header>
