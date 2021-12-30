<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>
            @yield('title')
        </title>

        <!-- Styles -->
        <link href="{{ asset('dist/css/main.css') }}" rel="stylesheet">

    </head>
    <body>
        <header class="header">
            <div class="container">
                <div class="row">
                    <div class="col-24">

                        {{-- <a href="{{ route('dashboard') }}">
                            XXX
                        </a>

                        {{ Auth::user()->name ?? 'XXX' }}

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>

                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name ?? 'XXX' }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email ?? 'XXX' }}</div> --}}

                        
                    </div>
                </div>
            </div>
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
