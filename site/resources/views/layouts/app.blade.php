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
            <a href="{{ url('/') }}" class="navbar-brand">
                <img src="{{ asset('dist/img/logo.svg') }}" alt="painting-logo" class="header__logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader"
                aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
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
                        <a href="{{ route('logout') }}" class="nav-link header__nav-link"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-24 col-md-6">
                    <h5 class="footer__paintit">
                        PaintIT!
                    </h5>
                    <p class="footer__text">
                        Jesteśmy platformą internetową łączącą ludzi z całego świata, którzy tworzą i kolekcjonują
                        wyjątkowe produkty. Serwis wpierający młodych artystów, którzy poszukują inspiracji.
                    </p>
                </div>
                <div class="col-24 col-md-12">
					<div class="text-center">
						<div class="footer__link">
							<ul class="nav flex-column">
								<li class="nav-item">
								  <a class="nav-link" href="{{ url('/terms') }}">Regulamin</a>
								</li>
								<li class="nav-item">
								  <a class="nav-link" href="{{ url('/instruction') }}">Jak korzystać?</a>
								</li>
							  </ul>
						</div>
					</div> 
                </div>
                <div class="col-24 col-md-3">
                    <p class="footer__text">
                        Kontakt<br>
						555 555 123<br>
						Milczańska 22/5<br>
						61-000 Poznań
                    </p>
				</div>
				<div class="col-24 col-md-3">
                    <div class="d-flex justify-content-end">
                        <img src="{{ asset('dist/img/logo.svg') }}" alt="painting-logo" class="header__logo">
                    </div>
				</div>
                </div>
            </div>
            <div class="row">
                <div class="col-24 col-md-24">
                    <div class="footer__data">
                        2021 PaintIT!, Inc.
                    </div>
                </div>

            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('dist/js/main.js') }}" defer></script>
</body>

</html>
