@if (Route::currentRouteName() == 'home')
    <li class="nav-item current">
        <a class="nav-link disabled">Portada</a>
    </li>
@else
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">Portada</a>
    </li>
@endif
@if (Request::segment(1) === 'competiciones')
    <li class="nav-item current">
        <a class="nav-link disabled">Competiciones</a>
    </li>
@else
    <li class="nav-item">
        <a class="nav-link" href="{{ route('competitions') }}">Competiciones</a>
    </li>
@endif
@if (Route::currentRouteName() == 'market')
    <li class="nav-item current">
        <a class="nav-link disabled">Mercado</a>
    </li>
@else
    <li class="nav-item">
        <a class="nav-link" href="#">Mercado</a>
    </li>
@endif
@if (Route::currentRouteName() == 'participants')
    <li class="nav-item current">
        <a class="nav-link disabled">Participantes</a>
    </li>
@else
    <li class="nav-item">
        <a class="nav-link" href="{{ route('participants') }}">Participantes</a>
    </li>
@endif
@if (Route::currentRouteName() == 'rules')
    <li class="nav-item current">
        <a class="nav-link disabled">Reglas</a>
    </li>
@else
    <li class="nav-item">
        <a class="nav-link" href="#">Reglas</a>
    </li>
@endif
