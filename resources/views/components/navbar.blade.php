@vite(['resources/js/nav.js'])
<header class="header">
    <div class="logo-container">
        <a href="/"><img class="logo" src="{{ asset('movienight-logo.png') }}" alt="Movienight logo"></a>
    </div>
    <div class="flags">
        <li class="flag"><a href="/en">
            <img src="{{ asset('Flag_of_United_Kingdom-4096x2048.png') }}" width="50" height="30">
        </a></li>
        <li class="flag"><a href="/es">
            <img src="{{ asset('Flag_of_Spain-4096x2731.png') }}" width="50" height="30">
        </a></li>
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
                    <a class="login-button" href="{{ route('logout', app()->getLocale()) }}" id="loginSubmit">{{ __('messages.logout') }}</a>
                    <form id="logout-form" action="{{ route('logout', app()->getLocale()) }}" method="POST" style="display:none">
                        @csrf
                    </form>
                </li>
                @endguest
            </ul>
        </nav>
    </div>
</header>

