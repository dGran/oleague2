<ul>
	<li class="{{ \Route::current()->getName() == 'market' ? 'active' : '' }}">
		<a href="{{ route('market') }}">
			<i class="icon-transfer"></i>
			<span>Resumen</span>
		</a>
	</li>
	<li class="{{ \Route::current()->getName() == 'club.roster' ? 'active' : '' }}">
		<a href="{{ route('club.roster', 'ss') }}">
			<i class="icon-search-player"></i>
			<span>Buscador</span>
		</a>
	</li>
	<li class="{{ \Route::current()->getName() == 'club.economy' ? 'active' : '' }}">
		<a href="{{ route('club.economy', 'ss') }}">
			<i class="icon-sale"></i>
			<span>Escaparate</span>
		</a>
	</li>

	@if (auth()->user() && user_is_participant(auth()->user()->id))
		<li class="ml-2 pl-3 {{ \Route::current()->getName() == 'club.press' ? 'active' : '' }}" style="border-left: 1px solid #414E5B;">
			<a href="{{ route('club.press', 'ss') }}">
				<i class="icon-my-team"></i>
				<span>Mi equipo</span>
			</a>
		</li>
		<li class="{{ \Route::current()->getName() == 'club.press' ? 'active' : '' }}">
			<a href="{{ route('club.press', 'ss') }}">
				<i class="icon-negotiation"></i>
				<span>Negocios</span>
			</a>
		</li>
		<li class="{{ \Route::current()->getName() == 'club.press' ? 'active' : '' }}">
			<a href="{{ route('club.press', 'ss') }}">
				<i class="icon-push-pin"></i>
				<span>Mi lista</span>
			</a>
		</li>
	@endif

</ul>