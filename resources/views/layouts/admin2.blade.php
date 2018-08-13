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

<div id="container">
    <div id="sidebar">
        <!-- Sidebar contents -->
        <div id="sidebar-content">
            @include('admin.partials.menu')
        </div>
    </div><!--
 --><div id="content">
        <!-- Main contents -->
        <div id="main-content">
            @yield('content')
        </div>
    </div><!--
 --><div id="sidebar2">
        <!-- Sidebar contents -->
        <div id="sidebar2-content">
            @yield('right-side')
        </div>
    </div>
</div>

{{-- 	<section class="section left d-none d-lg-flex">
		<div class="top-left">
			{{ config('app.name', 'Laravel') }}
		</div>
		<div class="bottom left">
			@include('admin.partials.menu')
		</div>
	</section>

	<section class="section center">
		<div class="top-right">
			Panel del Administración
		</div>
		<div class="bottom">
			@yield('content')
		</div>
	</section>

	<section class="section right d-none d-md-flex">
		<div class="top-right">
			<a href="{{ route('home') }}" class="text-white">Salir</a>
		</div>
		<div class="bottom right">
			@yield('right-side')
		</div>
	</section> --}}

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
</body>
</html>
