<li class="item {{ Request::is('admin') ? 'current' : '' }}">
    <a href="{{ route('admin') }}">
        <span>
            <i class="fas fa-home fa-fw mr-2"></i>
            Dashboard
        </span>
    </a>
</li>
<li class="section">
    competicion
</li>
<li class="item">
    <a href="">
        <span>
            <i class="fas fa-trophy fa-fw mr-2"></i>
            Competiciones
        </span>
    </a>
</li>
<li class="item">
    <a href="">
        <span>
            <i class="fas fa-list-ol fa-fw mr-2"></i>
            Marcado de zonas
        </span>
    </a>
</li>
<li class="section">
    mercado fichajes
</li>
<li class="item">
    <a href="">
        <span>
            <i class="fas fa-cogs fa-fw mr-2"></i>
            Configuración
        </span>
    </a>
</li>
<li class="item">
    <a href="">
        <span>
            <i class="fas fa-exchange-alt fa-fw mr-2"></i>
            Traspasos
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
<li class="item pending">
    <a>
        <span>
            <i class="fas fa-table fa-fw mr-2"></i>
            Jugadores
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
<li class="item {{ Request::is('admin/equipos*') ? 'current' : '' }}">
    <a href="{{ route('admin.teams') }}">
        <span>
            <i class="fas fa-table fa-fw mr-2"></i>
            Equipos
        </span>
    </a>
</li>
<li class="item pending">
    <a>
        <span>
            <i class="fas fa-table fa-fw mr-2"></i>
            Países
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