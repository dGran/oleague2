<div class="scrolling-wrapper">
	<ul>
		<li class="item {{ \Route::current()->getName() == 'market' ? 'active' : '' }}">
			<a href="{{ route('market') }}">
				<i class="icon-transfer"></i>
				<span>Resumen</span>
			</a>
		</li>
		<li class="item {{ \Route::current()->getName() == 'market.search' ? 'active' : '' }}">
			<a href="{{ route('market.search') }}">
				<i class="icon-search-player"></i>
				<span>Buscador</span>
			</a>
		</li>
		<li class="item {{ \Route::current()->getName() == 'market.sale' ? 'active' : '' }}">
			<a href="{{ route('market.sale') }}">
				<i class="icon-sale"></i>
				<span>Escaparate</span>
			</a>
		</li>

		@if (auth()->user() && user_is_participant(auth()->user()->id))
			<li class="item new-section {{ \Route::current()->getName() == 'market.my_team' ? 'active' : '' }}">
				<a href="{{ route('market.my_team') }}">
					<i class="icon-my-team"></i>
					<span>Mi equipo</span>
				</a>
			</li>
			<li class="item {{ \Route::current()->getName() == 'club.press' ? 'active' : '' }}">
				<a href="{{ route('club.press', 'ss') }}">
					<i class="icon-negotiation"></i>
					<span>Negocios</span>
					<span class="counter badge badge-danger rounded-circle">5</span>
				</a>
			</li>
			<li class="item {{ \Route::current()->getName() == 'club.press' ? 'active' : '' }}">
				<a href="{{ route('club.press', 'ss') }}">
					<i class="icon-push-pin"></i>
					<span>Mi lista</span>
				</a>
			</li>
		@endif

	</ul>
</div>