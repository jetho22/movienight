@vite(['resources/js/nav.js'])
<header class="header">
    <div class="logo-container">
        <a href="/"><img class="logo" src="{{ asset('movienight-logo.png') }}" alt="Movienight logo"></a>
    </div>
    <div class="nav-container">
        <nav class="nav">
            <ul class="nav-items">
                <li class="nav-item"><a href="{{ route('movies.index.localized', app()->getLocale()) }}">{{__('messages.movies')}}</a></li>
                @auth
                <li class="nav-item"><a href="{{ route('watchlist.localized', app()->getLocale()) }}">{{__('messages.watchlist')}}</a></li>
                @endauth
                @guest
                <li class="nav-item"> <a class="login-button" href="{{ route('login', app()->getLocale()) }}">{{ __('messages.login') }}</a></li>
                @else
                <li class="nav-item">
                    <a class="login-button" href="{{ route('logout') }}" id="loginSubmit">{{ __('messages.logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">
                        @csrf
                    </form>
                </li>
                @endguest
            </ul>
        </nav>
    </div>
</header>
