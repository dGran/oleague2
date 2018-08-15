<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <!-- Styles -->
    {{-- Bootstrap Select --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    {{-- font-awesome --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    {{-- Material Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css">
    {{-- Pretty checkbox --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pretty-checkbox/3.0.0/pretty-checkbox.min.css">

    {{-- Animate --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    {{-- Sweet Alert --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

</head>

<body>

    <div class="wrap">
        <div class="sidebar left">
            <!-- Sidebar contents -->
            <div class="sidebar-content">
                <div class="title sticky-top">
                    Panel de Admin
                </div>
                <ul class="left-menu">
                    @include('admin.partials.menu')
                </ul>
            </div>
        </div><!--
     --><div class="content">
            <div class="top clearfix">
                @include('admin.partials.top-menu')
            </div>
            <!-- Main contents -->
            <div class="main-content">
                @yield('content')
            </div>
        </div><!--
     --><div class="sidebar">
            <!-- Sidebar contents -->
            <div class="sidebar-content">
                @yield('right-side')
            </div>
        </div>
    </div>

    <div class="sidebar-mobile animated">
        <ul class="left-menu mobile">
            @include('admin.partials.menu')
        </ul>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    {{-- Bootstrap Select --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
    {{-- Sweet Alert --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    {{-- Mouse Trap --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mousetrap/1.6.2/mousetrap.min.js"></script>

    @yield('js')

    <script>
        $("#btn-menu").click(function(){
            if ($(".sidebar-mobile").is(':visible')) {
                $('.sidebar-mobile').removeClass('slideInLeft');
                $('.sidebar-mobile').addClass('slideOutLeft');
                $(this).children('i').removeClass('fa-times');
                $(this).children('i').addClass('fa-bars');
                $('.sidebar-mobile').hide();
            } else {
                $('.sidebar-mobile').removeClass('slideOutLeft');
                $('.sidebar-mobile').addClass('slideInLeft');
                $(this).children('i').removeClass('fa-bars');
                $(this).children('i').addClass('fa-times');
                $('.sidebar-mobile').show();
            }
        });
    </script>
</body>
</html>
