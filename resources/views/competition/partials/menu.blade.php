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

		@if ($league->has_stats())
			<li class="item {{ \Route::current()->getName() == 'competitions.competition.stats' ? 'active' : '' }}">
				<a href="{{ route('competitions.competition.stats', [active_season()->slug, $group->phase->competition->slug]) }}">
					<i class="fas fa-chart-bar"></i>
					<span>Estadísticas</span>
				</a>
			</li>
		@endif
	</ul>
</div>