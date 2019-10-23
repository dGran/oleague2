<div class="scrolling-wrapper">
	<ul>
		<li class="item {{ \Route::current()->getName() == 'competitions.competition.table' ? 'active' : '' }}">
			<a href="{{ route('competitions.competition.table', [active_season()->slug, $group->phase->competition->slug]) }}">
				<i class="fas fa-th-list"></i>
				<span>Clasificación</span>
			</a>
		</li>

		<li class="item {{ \Route::current()->getName() == 'competitions.competition.calendar' ? 'active' : '' }}">
			<a href="{{ route('competitions.competition.calendar', [active_season()->slug, $group->phase->competition->slug]) }}">
				<i class="icon-soccer-ball"></i>
				<span>Partidos</span>
			</a>
		</li>

		<li class="item {{ \Route::current()->getName() == '' ? 'active' : '' }}">
			<a href="">
				<i class="fas fa-chart-bar"></i>
				<span>Estadísticas</span>
			</a>
		</li>

	</ul>
</div>