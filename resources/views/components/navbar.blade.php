@vite(['resources/js/nav.js'])
<header class="header">
    <div class="logo-container">
        <a href="/"><img class="logo" src="{{ asset('movienight-logo.png') }}" alt="Movienight logo"></a>
    </div>
    <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
        @foreach($available_locales as $locale_name => $available_locale)
            @if($available_locale === $current_locale)
                <span class="ml-2 mr-2 text-gray-700">{{ $locale_name }}</span>
            @else
                <a class="ml-1 underline ml-2 mr-2" href="language/{{ $available_locale }}">
                    <span>{{ $locale_name }}</span>
                </a>
            @endif
        @endforeach
    </div>
    <div class="nav-container">
        <nav class="nav">
            <ul class="nav-items">
                <li class="nav-item"><a href="/">{{ __('Movies') }}</a></li>
                @auth
                <li class="nav-item"><a href="/watchlist">{{ __('Your Watchlist') }}</a></li>
                @endauth
                @guest
                <li class="nav-item"> <a class="login-button" href="/login">{{__("Log In")}}</a></li>
                @else
                <li class="nav-item">
                    <a class="login-button" href="{{ route('logout') }}" id="loginSubmit">{{ __('Log out') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">
                        @csrf
                    </form>
                </li>
                @endguest
            </ul>
        </nav>
    </div>
</header>
