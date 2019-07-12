<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,minimum-scale=1.0,initial-scale=1.0,maximum-scale=1.0,user-scalable=no,viewport-fit=cover">

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
        {{-- Progressively --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/progressively/1.2.5/progressively.css">

        {{-- My styles --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/fonts.css') }}" rel="stylesheet">
        @yield('style')
        <style>
            body{
                background: #353f48;
                /*background: #323232;*/
                /*background: #161b35;*/
            }
        </style>
    </head>

    <body class="d-flex flex-column">

        <header>
            @include('layouts.partials.top_menu')
            @yield('section')
        </header>

        <main class="">
            <div id="app">
                @yield('content')
            </div>
        </main>

        <footer class="footer">
            @yield('breadcrumb')
            @include('layouts.partials.footer')
            @yield('bottom-fixed')
        </footer>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        {{-- <script src="{{ asset('js/main.js') }}"></script> --}}
        {{-- Bootstrap Select --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/progressively/1.2.5/progressively.js"></script>

        @yield('js')
        <script>
            progressively.init();

            $( document ).ready(function() {
                var mediaquery = window.matchMedia("(max-width: 768px)");
                function handleOrientationChange(mediaquery) {
                    if (!mediaquery.matches) {
                        $("#menu").css('display', 'none');
                        $("#user-menu").css('display', 'none');
                        $(".hamburger").removeClass('active');
                    }
                }
                handleOrientationChange(mediaquery);
                mediaquery.addListener(handleOrientationChange);
            });

            $('.hamburger').click(function() {
                if ( $("#user-menu").css('display') == 'block' ){
                    $("#user-menu").removeClass('animated bounceInRight');
                    $("#user-menu").addClass('animated bounceOutRight');
                }

                if ( $("#menu").css('display') == 'none' ){
                    $("#menu").removeClass('animated bounceOutLeft');
                    $("#menu").addClass('animated bounceInLeft');
                    $("#menu").fadeIn();
                    $('.hamburger').addClass('active');
                } else {
                    $("#menu").fadeOut();
                    $("#menu").removeClass('animated bounceInLeft');
                    $("#menu").addClass('animated bounceOutLeft');
                    $('.hamburger').removeClass('active');
                }
            });

            $('#btn-user-menu').click(function() {
                if ( $("#menu").css('display') == 'block' ){
                    $("#menu").removeClass('animated bounceInLeft');
                    $("#menu").addClass('animated bounceOutLeft');
                    $('.hamburger').removeClass('active');
                }

                if ( $("#user-menu").css('display') == 'none' ){
                    $("#user-menu").removeClass('animated bounceOutRight');
                    $("#user-menu").addClass('animated bounceInRight');
                    $("#user-menu").fadeIn();
                } else {
                    $("#user-menu").fadeOut();
                    $("#user-menu").removeClass('animated bounceInRight');
                    $("#user-menu").addClass('animated bounceOutRight');
                }
            });

            // margin bottom of bottom fixed when is visible
            if ( $(".bottom-fixed").css('display') == 'block' ) {
                var margin = 8 + $('.bottom-fixed').height();
                $('.footer').css({'margin-bottom': margin + 'px'});
            };
        </script>
    </body>

</html>
