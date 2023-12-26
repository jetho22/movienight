@vite(['resources/scss/login.scss', 'resources/css/app.css', 'resources/js/app.js', 'resources/js/register.js'])

    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="black">
    <title>Movienight | Register</title>
    <meta name="description" content="Create watch lists for your movie nights">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
</head>
<body class="background font-color">
<main class="main">
    <div class="page">
        <header class="header">
            <a href="/">{{ __('Back to home page') }}</a>
            <h1>{{__("Register account")}}</h1>
        </header>
        <form class="register-form" id="register" method="post" action="{{ route('register') }}">
            @csrf
            <label for="name">{{__("Name")}}</label>
            <input id="name" name="name" type="text" placeholder={{__("Name")}}>
            <label for="username">{{__("Username")}}</label>
            <input id="username" name="username" type="text" placeholder={{__("Username")}}>
            <label for="email">{{__("Email")}}</label>
            <input id="email" name="email" type="email" placeholder={{__("Email")}} value="{{ old('email') }}">
            <label for="password">{{__("Password")}}</label>
            <input id="password" name="password" type="password" placeholder={{__("Password")}}>
            <input type="submit" form="register" value={{__("Register")}} class="register-button" id="submit-button" disabled/>
            <div class="register">{{__("Already a user? Login")}} <a href="/login">{{__("here")}}.</a></div>
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
            @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
        </form>
    </div>
</main>
</body>
</html>
