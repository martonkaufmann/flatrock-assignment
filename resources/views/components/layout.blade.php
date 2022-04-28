<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Assigment</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
        <nav class="nav justify-content-end">
            @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button class="btn">
                    {{ __('Log Out') }}
                </button>
            </form>
            @else
                <a class="btn" href="{{ route('login') }}">Log in</a>
            @endauth
        </nav>
        <main class="container">
        {{ $slot }}
        </main>
    </body>
</html>
