<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>
            @yield('title')
        </title>

        <!-- Styles -->
        <link href="{{ asset('dist/css/main.css') }}" rel="stylesheet">

    </head>
    <body>
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-24">
                        [LOGO]
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
        <script src="{{ asset('vendor/jquery.min.js') }}"></script>
        <script src="{{ asset('dist/js/main.js') }}" defer></script>
    </body>
</html>
