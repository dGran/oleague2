<section class="top-menu">
    <div class="row align-items-center mx-2 mx-md-5 mx-lg-2">
        <div class="col d-inline-block d-md-none">
            <button class="hamburger hamburger-cancel">
                <span class="icon"></span>
            </button>
        </div>
        <div class="col-auto d-none d-md-inline-block">
            <a class="navbar-brand" href="{{ url('/') }}">
                <figure class="logo d-none d-md-inline-block">
                    <img src="{{ asset('img/logo.png') }}" alt="logo">
                </figure>
                LigasPesXbox
            </a>
        </div>
        <div class="col-auto d-none d-md-inline-block">
            <nav>
                <ul class="nav">
                    @include('layouts.partials.menu')
                </ul>
            </nav>
        </div>
        <div class="col-auto d-inline-block d-md-none">
            <h1>
                <a class="navbar-brand" href="{{ url('/') }}">
                    <figure class="logo">
                        <img src="{{ asset('img/logo.png') }}" alt="logo">
                    </figure>
                    LigasPesXbox
                </a>
            </h1>
        </div>
        <div class="col user text-right">

            <div class="btn-group dropright">
                @guest
                    <div class="d-none d-lg-inline-block pt-2">
                        <a class="text-white" href="{{ route('login') }}">Iniciar sesión</a>
                        <span class="text-white">/</span>
                        <a  class="text-white" href="{{ route('register') }}">Regístrate</a>
                    </div>
                    <div class="btn-group dropup">
                        <a id="btn-user-menu">
                            <figure class="user-img ml-3">
                                <img src="{{ asset('img/avatars/guest.png') }}" alt="" class="rounded-circle">
                            </figure>
                        </a>
                    </div>
                @else
                    @if (auth()->user()->hasProfile())
                        <a id="btn-user-menu">
                            <figure class="user-img">
                                <img src="{{ auth()->user()->profile->avatar }}" alt="" class="rounded-circle">
                            </figure>
                        </a>
                    @else
                        <a id="btn-user-menu">
                            <figure class="user-img">
                                <img src="{{ asset('img/avatars/default.png') }}" alt="" class="rounded-circle">
                            </figure>
                        </a>
                    @endif
                @endguest
            </div>
        </div>
    </div>
</section>

<aside id="menu">
    <nav>
        <div class="p-3">
            @guest
                <div class="row">
                    <div class="col-6 text-right">
                        <a href="{{ route('login') }}" class="text-white pr-2">
                            Iniciar sesión
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('register') }}" class="text-white pl-2">
                            Regístrate
                        </a>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-12 text-center text-white">
                        Hola, {{ auth()->user()->name }}
                    </div>
                </div>
            @endguest
        </div>
        <ul class="nav flex-column">
            @include('layouts.partials.menu')
        </ul>
    </nav>
</aside>


<aside id="user-menu">
    <nav>
        <div class="p-3">
            @guest
                <div class="row">
                    <div class="col-6 text-right">
                        <a href="{{ route('login') }}" class="text-white pr-2">
                            Iniciar sesión
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('register') }}" class="text-white pl-2">
                            Regístrate
                        </a>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-12 text-center text-white">
                        Hola, {{ auth()->user()->name }}
                    </div>
                </div>
            @endguest
        </div>
        <ul class="nav flex-column">
            @include('layouts.partials.user_menu')
        </ul>
    </nav>
</aside>

{{-- <nav class="navbar navbar-dark bg-dark text-white" id="top-menu">
    <div class="container">
        <h1>
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </h1>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @else
                    @if (auth()->user()->hasRole('admin'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin') }}">Admin</a>
                    </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profileEdit') }}">
                                Perfil
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav> --}}