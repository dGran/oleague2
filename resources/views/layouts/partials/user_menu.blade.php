@auth
    <li class="nav-item {{ \Request::is('notificaciones') ? 'current' : '' }}">
        <a class="nav-link notifications {{ \Request::is('notificaciones') ? 'disabled' : '' }}" href="{{ route('notifications') }}">
            <i class="icon-notification"></i>
            <span>
                <span class="counter badge badge-warning rounded-circle {{ auth()->user()->uread_notifications() == 0 ? 'd-none' : '' }}">
                    {{ auth()->user()->uread_notifications() > 9 ? '9+' : auth()->user()->uread_notifications() }}
                </span>
                Notificaciones
            </span>
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

    @if (user_is_participant(auth()->user()->id))
        @if (active_season()->participant_has_team)
            <li class="nav-item category">
                ACCESOS RAPIDOS
            </li>
            <li class="nav-item {{ \Request::is('clubs/'. participant_of_user()->team->slug) ? 'current' : '' }}">
                <a class="nav-link offers {{ \Request::is('clubs/'. participant_of_user()->team->slug) ? 'disabled' : '' }}" href="{{ route('club', [active_season()->slug, participant_of_user()->team->slug]) }}">
                    <i class="icon-stadium"></i>
                    <span>
                        Mi Club
                    </span>
                </a>
            </li>
            @if (active_season()->use_rosters)
                <li class="nav-item {{ \Request::is('mercado/mi-equipo') ? 'current' : '' }}">
                    <a class="nav-link offers {{ \Request::is('mercado/mi-equipo') ? 'disabled' : '' }}" href="{{ route('market.my_team') }}">
                        <i class="icon-my-team"></i>
                        <span>
                            Mi Equipo
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link offers" href="{{ route('market.trades.received') }}">
                        <i class="icon-sale"></i>
                        <span>
                        <span class="counter badge badge-warning rounded-circle {{ (participant_of_user()->trades_received_pending() == 0) ? 'd-none' : '' }}">
                            {{ participant_of_user()->trades_received_pending() > 9 ? '9+' : participant_of_user()->trades_received_pending() }}
                        </span>
                        Ofertas recibidas
                    </span>
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link offers" href="{{ route('club.pending_matches', [active_season()->slug, participant_of_user()->team->slug]) }}">
                    <i class="icon-xbox-controller"></i>
                    <span>
                        <span class="counter badge badge-warning rounded-circle {{ (participant_of_user()->pending_matches() == 0) ? 'd-none' : '' }}">
                            {{ participant_of_user()->pending_matches() > 9 ? '9+' : participant_of_user()->pending_matches() }}
                        </span>
                        Partidas pendientes
                    </span>
                </a>
            </li>
        @endif
    @endif
    <li class="nav-item category">
        MI CUENTA
    </li>
    <li class="nav-item {{ \Request::is('perfil*') ? 'current' : '' }}">
        <a class="nav-link {{ \Request::is('perfil*') ? 'disabled' : '' }}" href="{{ route('profileEdit') }}">
            <i class="icon-user-card"></i>
            <span>Perfil</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}">
            <i class="icon-logout"></i>
            <span>Cerrar sesión</span>
        </a>
    </li>
@endauth

@auth
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
@endauth
