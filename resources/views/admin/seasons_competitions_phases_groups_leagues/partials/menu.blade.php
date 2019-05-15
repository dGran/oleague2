<ul class="nav nav-pills px-3 px-md-0 py-2 border-top border-bottom bg-light">
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.season_competitions_phases_groups_leagues.table') ? 'active' : '' }}" href="{{ route('admin.season_competitions_phases_groups_leagues.table', [$league->group->phase->competition->slug, $league->group->phase->slug, $league->group->slug]) }}">
        	@if (Route::is('admin.season_competitions_phases_groups_leagues.table'))
        		Clasificación
        	@else
        		<i class="fas fa-th-list"></i>
        	@endif
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.season_competitions_phases_groups_leagues.calendar') ? 'active' : '' }}" href="{{ route('admin.season_competitions_phases_groups_leagues.calendar', [$league->group->phase->competition->slug, $league->group->phase->slug, $league->group->slug]) }}">
        	@if (Route::is('admin.season_competitions_phases_groups_leagues.calendar'))
        		Partidos
        	@else
        		<i class="fas fa-futbol"></i>
        	@endif
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.season_competitions_phases_groups_leagues.stats') ? 'active' : '' }}" href="{{ route('admin.season_competitions_phases_groups_leagues.stats', [$league->group->phase->competition->slug, $league->group->phase->slug, $league->group->slug]) }}">
            @if (Route::is('admin.season_competitions_phases_groups_leagues.stats'))
                Estadísticas
            @else
                <i class="fas fa-chart-bar"></i>
            @endif
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.season_competitions_phases_groups_leagues') ? 'active' : '' }}" href="{{ route('admin.season_competitions_phases_groups_leagues', [$league->group->phase->competition->slug, $league->group->phase->slug, $league->group->slug]) }}">
        	@if (Route::is('admin.season_competitions_phases_groups_leagues'))
        		Configuración
        	@else
        		<i class="fas fa-cog"></i>
        	@endif
        </a>
    </li>
</ul>