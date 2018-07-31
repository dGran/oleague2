<section class="top-menu">
    <div class="container">
        <div class="row align-items-center">
            <div class="col d-inline-block d-md-none">
                <i class="fas fa-bars" id="btn-menu"></i>
            </div>
            <div class="col d-none d-md-inline-block">
                <figure class="logo d-none d-lg-inline-block">
                    <img src="{{ asset('img/logo.png') }}" alt="logo">
                </figure>
                <h1>
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </h1>
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
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </h1>
            </div>
            <div class="user col text-right">

                <div class="btn-group dropright">
                    @guest
                        <div class="d-none d-lg-inline-block">
                            <a href="{{ route('login') }}">Iniciar sesión</a> / <a href="{{ route('register') }}">Registrarse</a>
                        </div>
                        <a class="dropdown" id="dropdownUserMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <figure class="user-img ml-3">
                                <img src="{{ asset('img/avatars/guest.png') }}" alt="" class="rounded-circle">
                            </figure>
                        </a>
                    @else
                        @if (auth()->user()->hasProfile())
                            <a class="dropdown" id="dropdownUserMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <figure class="user-img">
                                    <img src="{{ auth()->user()->profile->avatar }}" alt="" class="rounded-circle">
                                </figure>
                            </a>
                        @else
                            <a class="dropdown" id="dropdownUserMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <figure class="user-img">
                                    <img src="{{ asset('img/avatars/default.png') }}" alt="" class="rounded-circle">
                                </figure>
                            </a>
                        @endif
                    @endguest
                    <div class="dropdown-menu animated bounceIn" aria-labelledby="dropdownUserMenu">
                        <h6 class="dropdown-header">Invitado</h6>
                        <a href="{{ route('login') }}" class="dropdown-item">
                            Iniciar sesión
                        </a>
                        <a href="{{ route('register') }}" class="dropdown-item">
                            Registro
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<aside id="menu">
    <nav>
        <ul class="nav flex-column">
            @include('layouts.partials.menu')
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