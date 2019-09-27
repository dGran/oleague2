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
		<li class="item {{ \Request::is('mercado/equipos*') ? 'active' : '' }}">
			<a href="{{ route('market.teams') }}">
				<i class="icon-teams"></i>
				<span>Equipos</span>
			</a>
		</li>

		@if (auth()->user() && user_is_participant(auth()->user()->id))
			<li class="item new-section {{ \Route::current()->getName() == 'market.my_team' ? 'active' : '' }}">
				<a href="{{ route('market.my_team') }}">
					<i class="icon-my-team"></i>
					<span>Mi equipo</span>
				</a>
			</li>
			<li class="item {{ \Request::is('mercado/negociaciones*') ? 'active' : '' }}">
				<a href="{{ route('market.trades') }}">
					<i class="icon-negotiation"></i>
					<span>Negocios</span>
					@if (participant_of_user()->trades_received->count() > 0)
						<span class="counter badge badge-danger rounded-circle">
							{{ participant_of_user()->trades_received->count() }}
						</span>
					@endif
				</a>
			</li>
			<li class="item {{ \Route::current()->getName() == 'market.favorites' ? 'active' : '' }}">
				<a href="{{ route('market.favorites') }}">
					<i class="fas fa-heart"></i>
					<span>Favoritos</span>
				</a>
			</li>
		@endif

	</ul>
</div>