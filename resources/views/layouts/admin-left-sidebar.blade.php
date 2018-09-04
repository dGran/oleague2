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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
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
    {{-- Pace --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-loading-bar.min.css">

    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

</head>

<body>

    <div class="wrap">
        <div class="sidebar left">
            <!-- Sidebar contents -->
            <div class="sidebar-content">
                <div class="title sticky-top">
                    <i class="fas fa-cogs mr-2"></i>
                    ADMIN PANEL
                </div>
                <ul class="left-menu">
                    @include('admin.partials.menu')
                </ul>
                <p style="color: #a2a2a2; font-size: 13px; padding: 1em">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed incidunt, nam nostrum ut autem reiciendis accusantium molestias! Officiis reprehenderit culpa quas optio repellendus vero, corrupti ab in nisi distinctio vitae!
                </p>
            </div>
        </div><!--
     --><div class="content without-right-side">
            <div class="top clearfix">
                @include('admin.partials.top-menu')
            </div>
            <!-- Main contents -->
            <div class="main-content">
                @yield('content')
            </div>
        </div>
    </div>

    <div class="sidebar-mobile animated">
        <ul class="left-menu mobile">
            @include('admin.partials.menu')
        </ul>
    </div>

    @yield('modal')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- Bootstrap Select --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    {{-- Sweet Alert --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    {{-- Mouse Trap --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mousetrap/1.6.2/mousetrap.min.js"></script>
    {{-- Pace --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>

    @yield('js')

    <script>

        $(function() {
            setTimeout(function() {
                $(".autohide").fadeTo(1000, 500).slideUp(500, function(){
                    $(".autohide").slideUp(500);
                });
            }, 2000);

            $('.search-clear').on("click", function() {
                $('.search-input').val('');
            });
            $('.search-input').keydown(function(e){
                if (e.keyCode == 27) {
                    $(this).val('');
                }
            });
            $(".search-input").focus(function(){
                $(this).select();
            });
        });

        $("#btn-menu").click(function(){
            if ($(".sidebar-mobile").is(':visible')) {
                $(this).children('i').removeClass('fa-times');
                $(this).children('i').addClass('fa-bars');
                $('.sidebar-mobile').hide();
            } else {
                $(this).children('i').removeClass('fa-bars');
                $(this).children('i').addClass('fa-times');
                $('.sidebar-mobile').show();
            }
        });

    </script>
</body>
</html>