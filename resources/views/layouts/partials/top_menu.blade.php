<section class="top-menu">
    <div class="container px-3">
        <div class="row align-items-center" style="max-height: 54px; min-height: 54px;">
            <div class="col d-inline-block d-md-none">
                <button class="hamburger hamburger-cancel">
                    <span class="icon"></span>
                </button>
            </div>
            <div class="col-auto ">
                <h1>
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <i class="icon-logo"></i>
                        <span>LigasPesXbox</span>
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
            <div class="col user text-right">
                <div class="btn-group dropright">
                    @guest
                        <div class="d-none d-lg-inline-block">
                            <a class="text-white" href="{{ route('login') }}">Iniciar sesión</a>
                            <span class="text-white">/</span>
                            <a  class="text-white" href="{{ route('register') }}">Regístrate</a>
                        </div>
                        {{-- img patch for javascript --}}
                        <img class="d-none" id="btn-user-close" src="{{ asset('img/avatars/close.png') }}">
                        {{-- end img patch for javascript --}}
                        <div class="btn-group dropup">
                            <a class="btn-user-menu" href="{{ route('login') }}">
                                <figure class="user-img ml-3">
                                    <img class="guest" src="{{ asset('img/avatars/guest.png') }}" alt="" class="rounded-circle">
                                </figure>
                            </a>
                        </div>
                    @else
                        @if (auth()->user()->hasProfile())
                            <a id="btn-user-menu" class="btn-user-menu">
                                @if (auth()->user()->uread_notifications() > 0)
                                    <img class="counter animated tada infinite" src="{{ asset('img/notifications.png') }}" alt="">
                                @endif
                                <figure class="user-img">
                                    <img class="{{ auth()->user()->profile->avatar ? '' : 'default' }}" src="{{ asset(auth()->user()->profile->getAvatarFormatted()) }}" alt="">
                                </figure>
                            </a>
                        @else
                            <a id="btn-user-menu" class="btn-user-menu">
                                <figure class="user-img">
                                    <img class="default" src="{{ asset('img/avatars/default.png') }}" alt="">
                                </figure>
                            </a>
                        @endif
                    @endguest
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