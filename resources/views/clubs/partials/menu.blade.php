<ul>
	<li class="{{ \Route::current()->getName() == 'club' ? 'active' : '' }}">
		<a href="{{ route('club', [$season_slug, $participant->team->slug]) }}">
			<i class="icon-stadium"></i>
			<span>Club</span>
		</a>
	</li>
	<li class="{{ \Route::current()->getName() == 'club.roster' ? 'active' : '' }}">
		<a href="{{ route('club.roster', [$season_slug, $participant->team->slug]) }}">
			<i class="icon-roster"></i>
			<span>Plantilla</span>
		</a>
	</li>
	<li class="{{ \Route::current()->getName() == 'club.economy' ? 'active' : '' }}">
		<a href="{{ route('club.economy', [$season_slug, $participant->team->slug]) }}">
			<i class="icon-economy"></i>
			<span>Economía</span>
		</a>
	</li>
	<li class="{{ \Route::current()->getName() == 'club.calendar' ? 'active' : '' }}">
		<a href="{{ route('club.calendar', [$season_slug, $participant->team->slug]) }}">
			<i class="icon-soccer-field"></i>
			<span>Calendario</span>
		</a>
	</li>
	<li class="{{ \Route::current()->getName() == 'club.pending_matches' ? 'active' : '' }}">
		<a href="{{ route('club.pending_matches', [$season_slug, $participant->team->slug]) }}">
			<i class="icon-xbox-controller"></i>
			<span>Pendientes</span>
		</a>
	</li>
	<li class="{{ \Route::current()->getName() == 'club.press' ? 'active' : '' }}">
		<a href="{{ route('club.press', [$season_slug, $participant->team->slug]) }}">
			<i class="icon-microphone"></i>
			<span>Prensa</span>
		</a>
	</li>
</ul>
