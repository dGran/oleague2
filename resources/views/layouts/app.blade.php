<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        {{-- font-awesome --}}
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
        {{-- Bootstrap Select --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
        {{-- Animate --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

        {{-- My styles --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @yield('style')
    </head>

    <body class="d-flex flex-column">
        <header>
            @include('layouts.partials.top_menu')
            @yield('section')
        </header>

        <main class="container-fluid flex-grow px-2 px-md-3">
            <div id="app">
                @yield('breadcrumb')
                @yield('content')
            </div>
        </main>

        <footer>
            @include('layouts.partials.footer')
        </footer>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        {{-- Bootstrap Select --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

        @yield('js')
        <script>
            $( document ).ready(function() {

                var mediaquery = window.matchMedia("(max-width: 768px)");
                function handleOrientationChange(mediaquery) {
                    if (!mediaquery.matches) {
                        $("#menu").css('display', 'none');
                        $("#btn-menu").removeClass('fa-times');
                        $("#btn-menu").addClass('fa-bars');
                    }
                }
                handleOrientationChange(mediaquery);
                mediaquery.addListener(handleOrientationChange);

                $("#btn-menu").click(function(){
                    if ( $("#menu").css('display') == 'none' ){
                        $("#menu").removeClass('animated bounceOutLeft');
                        $("#menu").addClass('animated bounceInLeft');
                        $("#menu").fadeIn();
                        $("#btn-menu").removeClass('fa-bars');
                        $("#btn-menu").addClass('fa-times');
                    } else {
                        $("#menu").removeClass('animated bounceInLeft');
                        $("#menu").addClass('animated bounceOutLeft');
                        $("#menu").fadeOut();
                        $("#btn-menu").removeClass('fa-times');
                        $("#btn-menu").addClass('fa-bars');
                    }
                });

            });
        </script>
    </body>

</html>
