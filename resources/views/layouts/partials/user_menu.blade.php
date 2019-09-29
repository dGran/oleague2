@guest

@else
    <li class="nav-item">
        <a class="nav-link" href="{{ route('competitions.pending_matches') }}">
            <i class="icon-xbox-controller"></i>
            <span>Partidas pendientes</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link notifications" href="{{ route('notifications') }}">
            <i class="icon-notification"></i>
            <span>
                <span class="counter badge badge-warning rounded-circle {{ auth()->user()->uread_notifications() == 0 ? 'd-none' : '' }}">
                    {{ auth()->user()->uread_notifications() > 9 ? '9+' : auth()->user()->uread_notifications() }}
                </span>
                Notificaciones
            </span>

        </a>
    </li>
    <li class="nav-item {{ \Request::is('perfil*') ? 'current' : '' }}">
        <a class="nav-link {{ \Request::is('perfil*') ? 'disabled' : '' }}" href="{{ route('profileEdit') }}">
            <i class="icon-user-card"></i>
            <span>LPX Perfil</span>
        </a>
    </li>
    @if (Auth::user()->hasRole('admin'))
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin') }}">
            <i class="icon-admin-panel"></i>
            <span>Panel de administración</span>
        </a>
    </li>
    @endif
    <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}">
            <i class="icon-logout"></i>
            <span>Cerrar sesión</span>
        </a>
    </li>
@endguest

@guest
    <li class="nav-item footer">
        Regístrate y únete a la comunidad.<br>
        Como usuario registrado podrás
        <ul class="text-dark">
            <li>Inscribirte en los torneos</li>
            <li>Subir resultados</li>
            <li>Participar en los mercados de fichajes</li>
            <li></li>
        </ul>
    </li>
@else
    <li class="nav-item share">
        <span class="d-inline-block d-md-none text-secondary">Compartir página</span>
        <ul class="text-center">
            <li>
                <a class="text-secondary" href="whatsapp://send?text={{ url()->current() }}" data-action="share/whatsapp/share">
                    <i class="fab fa-whatsapp"></i>
                </a>
            </li>
            <li>
                <a class="text-secondary" href="tg://msg_url?url={{ url()->current() }}">
                    <i class="fab fa-telegram"></i>
                </a>
            </li>
        </ul>
    </li>
@endguest
