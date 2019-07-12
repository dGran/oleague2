<li class="nav-item {{ Route::currentRouteName() == 'home' ? 'current' : '' }}">
    <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'disabled' : '' }}" href="{{ route('home') }}">
        <i class="far fa-address-card"></i>
        <span>Perfil de usuario</span>
    </a>
</li>
<li class="nav-item {{ \Request::is('clubs*') ? 'current' : '' }}">
    <a class="nav-link {{ \Request::is('clubs*') ? 'disabled' : '' }}" href="{{ route('clubs') }}">
        <i class="icon-clubs"></i>
        <span>Clubs</span>
    </a>
</li>
<li class="nav-item {{ \Request::is('competiciones*') ? 'current' : '' }}">
    <a class="nav-link {{ \Request::is('competiciones*') ? 'disabled' : '' }}" href="{{ route('competitions') }}">
        <i class="icon-trophy"></i>
        <span>Competiciones</span>
    </a>
</li>
<li class="nav-item {{ \Request::is('mercado*') ? 'current' : '' }}">
    <a class="nav-link {{ \Request::is('mercado*') ? 'disabled' : '' }}" href="">
        <i class="icon-transfer"></i>
        <span>Mercado</span>
    </a>
</li>
<li class="nav-item {{ \Request::is('reglamento*') ? 'current' : '' }}">
    <a class="nav-link {{ \Request::is('reglamento*') ? 'disabled' : '' }}" href="">
        <i class="icon-judge"></i>
        <span>Reglas</span>
    </a>
</li>

<li class="nav-item share">
    <span class="d-inline-block d-md-none">Compartir página</span>
    <ul class="text-center">
        <li>
            <a href="whatsapp://send?text={{ url()->current() }}" data-action="share/whatsapp/share">
                <i class="fab fa-whatsapp"></i>
            </a>
        </li>
        <li>
            <a href="tg://msg_url?url={{ url()->current() }}">
                <i class="fab fa-telegram"></i>
            </a>
        </li>
    </ul>
</li>
