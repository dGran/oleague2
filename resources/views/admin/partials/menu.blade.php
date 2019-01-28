<li class="section">
    DASHBOARD
</li>

<li class="item {{ Request::is('admin') ? 'current' : '' }}">
    <a href="{{ route('admin') }}">
        <span>
            <i class="fas fa-chart-line fa-fw mr-2 mb-1"></i>
            Logs
        </span>
    </a>
</li>
<li class="item pending">
    <a href="">
        <span>
            <i class="fas fa-plug fa-fw mr-2"></i>
            Usuarios conectados
        </span>
    </a>
</li>

<li class="section">
    TORNEO
</li>
<li class="item pending">
    <a href="">
        <span>
            <i class="far fa-newspaper fa-fw mr-2"></i>
            Noticias
        </span>
    </a>
</li>
<li class="item pending">
    <a href="">
        <span>
            <i class="fas fa-users fa-fw mr-2"></i>
            Participantes
        </span>
    </a>
</li>
{{-- <li class="item {{ Request::is('admin/seasons*') ? 'current' : '' }}">
    <a href="{{ route('admin.seasons') }}">
        <span>
            <i class="fas fa-table fa-fw mr-2"></i>
            Temporadas
        </span>
    </a>
</li> --}}
<li class="item pending">
    <a href="">
        <span>
            <i class="fas fa-trophy fa-fw mr-2"></i>
            Competición
        </span>
    </a>
</li>
<li class="item pending">
    <a href="">
        <span>
            <i class="fas fa-user-shield fa-fw mr-2"></i>
            Plantillas
        </span>
    </a>
</li>
<li class="item pending">
    <a href="">
        <span>
            <i class="fas fa-exchange-alt fa-fw mr-2"></i>
            Traspasos
        </span>
    </a>
</li>
<li class="item pending">
    <a href="">
        <span>
            <i class="fas fa-piggy-bank fa-fw mr-2"></i>
            Economía
        </span>
    </a>
</li>
<li class="item pending">
    <a href="">
        <span>
            <i class="fas fa-book-open fa-fw mr-2"></i>
            Reglas
        </span>
    </a>
</li>
<li class="item pending">
    <a href="">
        <span>
            <i class="fas fa-cogs fa-fw mr-2"></i>
            Configuración
        </span>
    </a>
</li>
<li class="section">
    Tablas generales
</li>
<li class="item pending">
    <a>
        <span>
            <i class="fas fa-table fa-fw mr-2"></i>
            Usuarios
        </span>
    </a>
</li>
<li class="item {{ Request::is('admin/jugadores*') ? 'current' : '' }}">
    <a href="{{ route('admin.players') }}">
        <span>
            <i class="fas fa-table fa-fw mr-2"></i>
            Jugadores
        </span>
    </a>
</li>
<li class="item {{ Request::is('admin/equipos*') ? 'current' : '' }}">
    <a href="{{ route('admin.teams') }}">
        <span>
            <i class="fas fa-table fa-fw mr-2"></i>
            Equipos
        </span>
    </a>
</li>
<li class="item {{ Request::is('admin/categorias_equipos*') ? 'current' : '' }}">
    <a href="{{ route('admin.teams_categories') }}">
        <span>
            <i class="fas fa-table fa-fw mr-2"></i>
            Categorías de equipos
        </span>
    </a>
</li>
<li class="item {{ Request::is('admin/databases_jugadores*') ? 'current' : '' }}">
    <a href="{{ route('admin.players_dbs') }}">
        <span>
            <i class="fas fa-table fa-fw mr-2"></i>
            Databases de jugadores
        </span>
    </a>
</li>

<li class="section">
    Notificaciones
</li>
<li class="item pending">
    <a>
        <span>
            <i class="fas fa-table fa-fw mr-2"></i>
            Slack
        </span>
    </a>
</li>
<li class="item pending">
    <a>
        <span>
            <i class="fas fa-table fa-fw mr-2"></i>
            Telegram
        </span>
    </a>
</li>