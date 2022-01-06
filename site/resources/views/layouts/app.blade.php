<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>
            @yield('title')
        </title>

        <!-- Styles -->
        <link href="{{ asset('dist/css/main.css') }}" rel="stylesheet">

    </head>
    <body>
        <header class="header">
            <nav class="navbar navbar-expand-sm header__navbar">
                <a href="#" class="navbar-brand">
                    LOGO
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarHeader">
                    <ul class="navbar-nav ml-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item header__nav-item">
                                    <a href="{{ route('login') }}" class="nav-link header__nav-link">
                                        <span class="icon icon-acount"></span><br>
                                        Zaloguj się
                                    </a>
                                </li>
                            @endif
                        @else
                            {{-- <li class="nav-item header__nav-item">
                                <a href="#" class="nav-link header__nav-link">
                                    <span class="icon icon-heart-empty"></span><br>
                                    Ulubione
                                </a>
                            </li> --}}
                            <li class="nav-item header__nav-item">
                                <a href="{{ route('profile.index', Auth::user()->name) }}" class="nav-link header__nav-link">
                                    <span class="icon icon-acount"></span><br>
                                    Profil
                                </a>
                            </li>
                            <li class="nav-item header__nav-item">
                                <a href="{{ route('logout') }}" class="nav-link header__nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <span class="icon icon-logout"></span><br>
                                    Wyloguj
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </nav>
        </header>

        @yield('content')

        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-24">
                        FOOTER
                    </div>
                </div>
            </div>
        </footer>

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="{{ asset('dist/js/main.js') }}" defer></script>
    </body>
</html>
