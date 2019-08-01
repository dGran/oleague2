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
	<li class="{{ \Route::current()->getName() == 'market.sale' ? 'active' : '' }}">
		<a href="{{ route('market.sale') }}">
			<i class="icon-sale"></i>
			<span>Escaparate</span>
		</a>
	</li>

	@if (auth()->user() && user_is_participant(auth()->user()->id))
		<li class="ml-2 pl-3 {{ \Route::current()->getName() == 'market.my_team' ? 'active' : '' }}" style="border-left: 1px solid #414E5B;">
			<a href="{{ route('market.my_team') }}">
				<i class="icon-my-team"></i>
				<span>Mi equipo</span>
			</a>
		</li>
		<li class="{{ \Route::current()->getName() == 'club.press' ? 'active' : '' }}">
			<a href="{{ route('club.press', 'ss') }}" style="position: relative;">
				<i class="icon-negotiation"></i>
				<span>Negocios</span>
				<span class="badge badge-danger rounded-circle" style="position: absolute; top: 16px; right: -5px; font-size: .9em; min-width: 21px; border: 1px solid #353f48">5</span>
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