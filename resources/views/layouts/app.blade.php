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
        {{-- Pretty checkbox --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pretty-checkbox/3.0.0/pretty-checkbox.min.css">
        {{-- Animate --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
        {{-- Sweet Alert --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
        {{-- Progressively --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/progressively/1.2.5/progressively.css">
        {{-- ION RangeSlider --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>

        {{-- My styles --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/fonts.css') }}" rel="stylesheet">
        @yield('style')
        <style>
            body{
                /*background: #353f48;*/
                /*background: #323232;*/
                background: #161b35;
            }
        </style>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        {{-- Bootstrap Select --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
        {{-- Sweet Alert --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
        {{-- Mouse Trap --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mousetrap/1.6.2/mousetrap.min.js"></script>
        {{-- ION RangeSlider --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>
        {{-- Progressively JS --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/progressively/1.2.5/progressively.js"></script>

    </head>

    <body class="d-flex flex-column">

        <header>
            @include('layouts.partials.top_menu')
            @yield('section')
        </header>

        <main>
            <div id="app">
                @include('layouts.partials.flash_message')
                @yield('content')
            </div>
            @yield('modal')
        </main>

        <footer class="footer">
            @yield('breadcrumb')
            @include('layouts.partials.footer')
            @yield('bottom-fixed')
        </footer>

        @yield('js')
        <!-- Scripts -->
        <script src="{{ asset('js/main.js') }}"></script>
    </body>

</html>
