<ul class="nav nav-pills px-3 px-md-0 py-2 border-top border-bottom bg-light">
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.season_competitions_phases_groups_playoffs.table') ? 'active' : '' }}" href="{{ route('admin.season_competitions_phases_groups_playoffs.table', [$playoff->group->phase->competition->slug, $playoff->group->phase->slug, $playoff->group->slug]) }}">
        	@if (Route::is('admin.season_competitions_phases_groups_playoffs.table'))
        		Clasificación
        	@else
        		<i class="fas fa-th-list"></i>
        	@endif
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.season_competitions_phases_groups_playoffs.rounds') ? 'active' : '' }}" href="{{ route('admin.season_competitions_phases_groups_playoffs.rounds', [$playoff->group->phase->competition->slug, $playoff->group->phase->slug, $playoff->group->slug]) }}">
        	@if (Route::is('admin.season_competitions_phases_groups_playoffs.rounds'))
        		Rondas
        	@else
        		<i class="fas fa-futbol"></i>
        	@endif
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.season_competitions_phases_groups_playoffs.stats') ? 'active' : '' }}" href="{{ route('admin.season_competitions_phases_groups_playoffs.stats', [$playoff->group->phase->competition->slug, $playoff->group->phase->slug, $playoff->group->slug]) }}">
            @if (Route::is('admin.season_competitions_phases_groups_playoffs.stats'))
                Estadísticas
            @else
                <i class="fas fa-chart-bar"></i>
            @endif
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.season_competitions_phases_groups_playoffs') ? 'active' : '' }}" href="{{ route('admin.season_competitions_phases_groups_playoffs', [$playoff->group->phase->competition->slug, $playoff->group->phase->slug, $playoff->group->slug]) }}">
        	@if (Route::is('admin.season_competitions_phases_groups_playoffs'))
        		Configuración
        	@else
        		<i class="fas fa-cog"></i>
        	@endif
        </a>
    </li>
</ul>