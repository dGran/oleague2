{{-- <ul>
	<li>
		<a href="{{ route('admin.general_settings') }}">
			<i class="fas fa-caret-right pr-1"></i>
			Configuración general
		</a>
	</li>
	<li>
		<a href="#">
			<i class="fas fa-caret-right pr-1"></i>
			Competición
		</a>
	</li>
	<li class="category">
		Tablas generales
	</li>
	<li>
		<a href="#">
			<i class="fas fa-caret-right pr-1"></i>
			Jugadores
		</a>
	</li>
	<li>
		<a href="{{ route('admin.teams') }}">
			<i class="fas fa-caret-right pr-1"></i>
			Equipos
		</a>
	</li>
	<li>
		<a href="#">
			<i class="fas fa-caret-right pr-1"></i>
			Paises
		</a>
	</li>
</ul>
 --}}

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
        <span class="submenu-icon ml-auto"></span>
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
<a href="#submenu2" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
    <div class="d-flex w-100 justify-content-start align-items-center">
        <span class="fa fa-user fa-fw mr-3"></span>
        <span class="menu-collapsed">Profile</span>
        <span class="submenu-icon ml-auto"></span>
    </div>
</a>
<!-- Submenu content -->
<div id="submenu2" class="collapse sidebar-submenu">
    <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
        <span class="menu-collapsed">Settings</span>
    </a>
    <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
        <span class="menu-collapsed">Password</span>
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
</a>
<!-- Separator without title -->
<li class="list-group-item sidebar-separator menu-collapsed"></li>
<!-- /END Separator -->
<a href="#" data-toggle="sidebar-colapse" class="bg-dark list-group-item list-group-item-action d-flex align-items-center">
    <div class="d-flex w-100 justify-content-start align-items-center">
        <span id="collapse-icon" class="fa fa-2x mr-3"></span>
        <span id="collapse-text" class="menu-collapsed">Collapse</span>
    </div>
</a>
<!-- Logo -->
<li class="list-group-item logo-separator d-flex justify-content-center">
    <img src="https://upload.wikimedia.org/wikipedia/commons/a/ab/Logo_TV_2015.png" width="30" height="30">
</li>