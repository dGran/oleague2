<ul class="left-menu">
    <li class="item {{ Request::is('admin') ? 'current' : '' }}">
        <a href="{{ route('admin') }}">
            <span class="fas fa-home fa-fw mr-2"></span>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="section">
        competicion
    </li>
    <li class="item">
        <a href="">
            <span class="fas fa-trophy fa-fw mr-2"></span>
            <span>Competiciones</span>
        </a>
    </li>
    <li class="item">
        <a href="">
            <span class="fas fa-list-ol fa-fw mr-2"></span>
            <span>Marcado de zonas</span>
        </a>
    </li>
    <li class="section">
        mercado fichajes
    </li>
    <li class="item">
        <a href="">
            <span class="fas fa-cogs fa-fw mr-2"></span>
            <span>Configuración</span>
        </a>
    </li>
    <li class="item">
        <a href="">
            <span class="fas fa-exchange-alt fa-fw mr-2"></span>
            <span>Traspasos</span>
        </a>
    </li>
    <li class="section">
        Tablas generales
    </li>
    <li class="item pending">
        <a>
            <span class="fas fa-table fa-fw mr-2"></span>
            <span>Usuarios</span>
        </a>
    </li>
    <li class="item pending">
        <a>
            <span class="fas fa-table fa-fw mr-2"></span>
            <span>Jugadores</span>
        </a>
    </li>
    <li class="item pending">
        <a>
            <span class="fas fa-table fa-fw mr-2"></span>
            <span>Categorías de equipos</span>
        </a>
    </li>
    <li class="item {{ Request::is('admin/equipos*') ? 'current' : '' }}">
        <a href="{{ route('admin.teams') }}">
            {{-- <div class="w-100 justify-content-start align-items-center"> --}}
                <span class="fas fa-table fa-fw mr-2"></span>
                <span>Equipos</span>
            {{-- </div> --}}
        </a>
    </li>
    <li class="item pending">
        <a>
            <span class="fas fa-table fa-fw mr-2"></span>
            <span>Países</span>
        </a>
    </li>

    <li class="section">
        Notificaciones
    </li>
    <li class="item pending">
        <a>
            <span class="fas fa-table fa-fw mr-2"></span>
            <span>Slack</span>
        </a>
    </li>
    <li class="section">
        Tablas generales
    </li>
    <li class="item pending">
        <a>
            <span class="fas fa-table fa-fw mr-2"></span>
            <span>Telegram</span>
        </a>
    </li>

</ul>


{{-- <!-- Separator with title -->
<li class="list-group-item text-muted d-flex align-items-center menu-collapsed">
    <small>COMPETICION</small>
</li>
<!-- /END Separator -->
<!-- Menu with submenu -->
<a href="#submenu1" data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action flex-column align-items-start">
    <div class="d-flex w-100 justify-content-start align-items-center">
        <span class="fas fa-home mr-3"></span>
        <span class="menu-collapsed">Dashboard</span>
        <span class="fas fa-caret-down ml-auto"></span>
    </div>
</a>
<!-- Submenu content -->
<div id="submenu1" class="collapse">
    <a href="#" class="list-group-item list-group-item-action">
        <span class="menu-collapsed">Charts</span>
    </a>
    <a href="#" class="list-group-item list-group-item-action">
        <span class="menu-collapsed">Reports</span>
    </a>
    <a href="#" class="list-group-item list-group-item-action">
        <span class="menu-collapsed">Tables</span>
    </a>
</div>
<a href="#" class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-start align-items-center">
        <span class="fa fa-tasks fa-fw mr-3"></span>
        <span class="menu-collapsed">Tasks</span>
    </div>
</a>
<!-- Separator with title -->
<li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
    <small>TABLAS GENERALES</small>
</li>
<!-- /END Separator -->
<a href="#" class="bg-dark list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-start align-items-center">
        <span class="fas fa-table fa-fw mr-3"></span>
        <span class="menu-collapsed">Categorías de Equipos</span>
    </div>
</a>
<a href="{{ route('admin.teams') }}" class="bg-dark list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-start align-items-center">
        <span class="fas fa-table fa-fw mr-3"></span>
        <span class="menu-collapsed">Equipos</span>
    </div>
</a>
<a href="#" class="bg-dark list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-start align-items-center">
        <span class="fas fa-table fa-fw mr-3"></span>
        <span class="menu-collapsed">Jugadores</span>
    </div>
</a>
<a href="#" class="bg-dark list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-start align-items-center">
        <span class="fas fa-table fa-fw mr-3"></span>
        <span class="menu-collapsed">Paises</span>
    </div>
</a>
<!-- Separator with title -->
<li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
    <small>NOTIFICACIONES</small>
</li>
<!-- /END Separator -->
<a href="#" class="bg-dark list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-start align-items-center">
        <span class="fab fa-telegram-plane fa-fw mr-3"></span>
        <span class="menu-collapsed">Telegram</span>
    </div>
</a>
<a href="#" class="bg-dark list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-start align-items-center">
        <span class="fab fa-slack-hash fa-fw mr-3"></span>
        <span class="menu-collapsed">Slack</span>
    </div>
</a>
<!-- Separator with title -->
<li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
    <small>COMPETICION</small>
</li>
<!-- /END Separator -->
<!-- Menu with submenu -->
<a href="#submenu1" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
    <div class="d-flex w-100 justify-content-start align-items-center">
        <span class="fas fa-home mr-3"></span>
        <span class="menu-collapsed">Dashboard</span>
        <span class="fas fa-caret-down ml-auto"></span>
    </div>
</a>
<!-- Submenu content -->
<div id="submenu1" class="collapse sidebar-submenu">
    <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
        <span class="menu-collapsed">Charts</span>
    </a>
    <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
        <span class="menu-collapsed">Reports</span>
    </a>
    <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
        <span class="menu-collapsed">Tables</span>
    </a>
</div>
<a href="#" class="bg-dark list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-start align-items-center">
        <span class="fa fa-tasks fa-fw mr-3"></span>
        <span class="menu-collapsed">Tasks</span>
    </div>
</a>
<!-- Separator with title -->
<li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
    <small>TABLAS GENERALES</small>
</li>
<!-- /END Separator -->
<a href="#" class="bg-dark list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-start align-items-center">
        <span class="fas fa-table fa-fw mr-3"></span>
        <span class="menu-collapsed">Categorías de Equipos</span>
    </div>
</a>
<a href="{{ route('admin.teams') }}" class="bg-dark list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-start align-items-center">
        <span class="fas fa-table fa-fw mr-3"></span>
        <span class="menu-collapsed">Equipos</span>
    </div>
</a>
<a href="#" class="bg-dark list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-start align-items-center">
        <span class="fas fa-table fa-fw mr-3"></span>
        <span class="menu-collapsed">Jugadores</span>
    </div>
</a>
<a href="#" class="bg-dark list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-start align-items-center">
        <span class="fas fa-table fa-fw mr-3"></span>
        <span class="menu-collapsed">Paises</span>
    </div>
</a>
<!-- Separator with title -->
<li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
    <small>NOTIFICACIONES</small>
</li>
<!-- /END Separator -->
<a href="#" class="bg-dark list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-start align-items-center">
        <span class="fab fa-telegram-plane fa-fw mr-3"></span>
        <span class="menu-collapsed">Telegram</span>
    </div>
</a>
<a href="#" class="bg-dark list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-start align-items-center">
        <span class="fab fa-slack-hash fa-fw mr-3"></span>
        <span class="menu-collapsed">Slack</span>
    </div>
</a> --}}