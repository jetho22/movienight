@vite(['resources/scss/login.scss', 'resources/css/app.css', 'resources/js/app.js'])

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
</head>
<body class="background font-color">
<main class="main">
    <div class="page">
        <header class="header">
            <a href="/">Back to home page</a>
            <h1>Log in</h1>
        </header>
        <form class="login-form" id="login" method="post" action="{{ route('authenticate') }}">
            @csrf
            <label for="email">Email</label>
            <input id="email" name="email" type="email" placeholder="email" value="{{ old('email') }}">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" placeholder="password">
            <input type="submit" form="login" value="login" class="login-button" id="submit-button" disabled/>
            <div class="register">Don't have a user? Register <a href="/register">here.</a></div>
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
            @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
        </form>
        <script>
            // Get the input elements and the submit button
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const submitButton = document.getElementById('submit-button');

            // Function to enable/disable the submit button based on input values
            function toggleSubmitButton() {
                const emailValue = emailInput.value.trim();
                const passwordValue = passwordInput.value.trim();
                submitButton.disabled = emailValue === '' || passwordValue === '';
            }

            // Add input event listeners to trigger the function on input changes
            emailInput.addEventListener('input', toggleSubmitButton);
            passwordInput.addEventListener('input', toggleSubmitButton);
        </script>
    </div>
</main>
</body>
</html>
