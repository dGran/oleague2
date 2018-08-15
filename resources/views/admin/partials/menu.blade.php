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
<li class="item pending">
    <a>
        <span class="fas fa-table fa-fw mr-2"></span>
        <span>Telegram</span>
    </a>
</li>